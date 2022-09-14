<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation;

use Coole\Config\Config;
use Coole\Console\CommandDiscoverer;
use Coole\ErrorHandler\ErrorHandlerInterface;
use Coole\Foundation\Exceptions\UnknownFileOrDirectoryException;
use Coole\HttpKernel\Controller\Controller;
use Coole\HttpKernel\Controller\HasControllerAble;
use Coole\Routing\Route;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline;
use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Throwable;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    use HasControllerAble;

    /**
     * @var string
     */
    public const VERSION = '1.1.0';

    /**
     * 已经注册的服务.
     *
     * @var array<ServiceProvider>
     */
    protected array $providers = [];

    /**
     * 是否已经引导服务.
     */
    protected bool $booted = false;

    public function __construct(array $options = [])
    {
        $this->bindApp();
        $this->bindConfig($options);
        $this->register(new AppServiceProvider($this));
    }

    /**
     * 注册服务.
     */
    public function register(ServiceProvider $serviceProvider): void
    {
        $this->providers[] = $serviceProvider;

        $serviceProvider->registering();
        $serviceProvider->register();
        $serviceProvider->registered();

        foreach ($serviceProvider->getBindings() as $key => $value) {
            $this->bind($key, $value);
        }

        foreach ($serviceProvider->getSingletons() as $key => $value) {
            $key = is_int($key) ? $value : $key;

            $this->singleton($key, $value);
        }
    }

    /**
     * 合并配置.
     */
    public function mergeConfig(string $key, array $value): void
    {
        $this['config'][$key] = $value;
    }

    /**
     * 添加配置.
     */
    public function addConfig(string $key, array $value): void
    {
        $this['config']->offsetExists($key) or $this['config'][$key] = $value;
    }

    /**
     * 获取版本号.
     */
    public static function version(): string
    {
        return static::VERSION;
    }

    /**
     * 加载 env.
     *
     * @param string|array<string> $paths
     */
    public function loadEnvFrom(string|array $paths): void
    {
        $dotenv = Dotenv::createUnsafeMutable($paths);
        $dotenv->load();
    }

    /**
     * 加载配置.
     *
     * @throws \Coole\Foundation\Exceptions\UnknownFileOrDirectoryException
     */
    public function loadConfigFrom(string $path, bool $force = false): void
    {
        if (! file_exists($path)) {
            throw UnknownFileOrDirectoryException::create($path);
        }

        if (is_file($path)) {
            $splFileInfos = [new SplFileInfo($path)];
        }

        if (is_dir($path)) {
            $splFileInfos = Finder::create()->depth(0)->files()->in($path)->name('*.php');
        }

        foreach ($splFileInfos as $splFileInfo) {
            $key = $splFileInfo->getBasename('.php');
            $value = require $splFileInfo->getPathname();

            $force ? $this->mergeConfig($key, $value) : $this->addConfig($key, $value);
        }
    }

    /**
     * 从指定路径合并配置.
     */
    public function mergeConfigFrom(string $path, ?string $key = null): void
    {
        /** @var \Coole\Config\Config $config */
        $config = $this->app['config'];

        if (is_null($key)) {
            $key = (new SplFileInfo($path))->getBasename('.php');
        }

        $config->set($key, array_merge(
            require $path, $config->get($key, [])
        ));
    }

    /**
     * 加载路由.
     *
     * @throws \Coole\Foundation\Exceptions\UnknownFileOrDirectoryException
     */
    public function loadRouteFrom(string $path): void
    {
        if (! file_exists($path)) {
            throw UnknownFileOrDirectoryException::create($path);
        }

        if (is_file($path)) {
            $routeFiles = [$path];
        }

        if (is_dir($path)) {
            $routeFiles = Finder::create()->depth(0)->files()->in($path)->name('*.php');
        }

        foreach ($routeFiles as $routeFile) {
            require_once $routeFile;
        }
    }

    /**
     * 加载命令.
     */
    public function loadCommandFrom(string $dir, string $namespace): void
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace);

        $this['console.command.collection']->push(...$commandDiscoverer->getCommands());
    }

    /**
     * 注册命令.
     *
     * @param array<string>|string $commands
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function commands(array|string $commands): void
    {
        foreach ((array) $commands as $command) {
            $this['console.command.collection']->add($this->make($command));
        }
    }

    /**
     * 批量注册服务.
     *
     * @param array<string> $providers
     */
    public function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->register(new $provider($this));
        }
    }

    /**
     * 启动运行服务.
     */
    public function run(?Request $request = null): void
    {
        if (null === $request) {
            // 创建请求对象
            $request = Request::createFromGlobals();
        }

        try {
            $this->instance('request', $request);

            // 引导服务
            $this->boot();

            // 通过中间件将请求转化为响应
            $response = $this->sendRequestThroughPipeline($request);
        } catch (Throwable $throwable) {
            $this->reportException($throwable);

            $response = $this->renderException($request, $throwable);
        }

        // 发送响应
        $response->send();

        // 终止请求/响应生命周期
        $this->terminate($request, $response);
    }

    /**
     * Report the exception to the exception handler.
     */
    protected function reportException(Throwable $throwable): void
    {
        $this[ErrorHandlerInterface::class]->report($throwable);
    }

    /**
     * Render the exception to a response.
     */
    protected function renderException(Request $request, Throwable $throwable): Response
    {
        return $this[ErrorHandlerInterface::class]->render($request, $throwable);
    }

    /**
     * 引导应用程序.
     */
    public function boot(): void
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;

        foreach ($this->providers as $provider) {
            $provider->booting();
            $provider->boot();
            $provider->booted();
        }
    }

    /**
     * 通过管道发送响应.
     */
    public function sendRequestThroughPipeline(Request $request): Response
    {
        return (new Pipeline())
            ->send($request)
            ->through($this->makeMiddleware($this->getCurrentRequestShouldExecutedMiddleware($request)))
            ->then(fn ($request) => $this->handle($request));
    }

    /**
     * 处理请求为响应且发送响应.
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MAIN_REQUEST, bool $catch = true): Response
    {
        return $this['http.kernel']->handle($request, $type, $catch);
    }

    /**
     * 终止请求/响应生命周期.
     */
    public function terminate(Request $request, Response $response): void
    {
        $this['http.kernel']->terminate($request, $response);
    }

    /**
     * 批量实例化中间件.
     *
     * @param string[]|object[]|Closure[]|string $middlewares
     *
     * @return mixed[]
     */
    public function makeMiddleware(string|array $middlewares): array
    {
        return array_map(function ($middleware) {
            is_string($middleware) and $middleware = $this->make($middleware);

            return $middleware;
        }, (array) $middlewares);
    }

    /**
     * 获取当前请求应该被执行的中间件.
     *
     * @return mixed[]
     */
    public function getCurrentRequestShouldExecutedMiddleware(Request $request): array
    {
        $middlewares = $this->getCurrentRequestMiddleware($request);

        $classMiddleware = array_filter($middlewares, static fn ($middleware) => is_string($middleware));

        $objectMiddleware = array_filter($middlewares, static fn ($middleware) => ! is_string($middleware));

        return array_merge(array_diff($classMiddleware, $this->getCurrentRequestExcludedMiddleware($request)), $objectMiddleware);
    }

    /**
     * 获取当前请求排除中间件.
     *
     * @return mixed[]
     */
    public function getCurrentRequestExcludedMiddleware(Request $request): array
    {
        return array_merge(
            $this->getExcludedMiddleware(),
            $this->getControllerExcludedMiddleware($request),
            $this->getRouteExcludedMiddleware($request)
        );
    }

    /**
     * 获取当前请求中间件.
     *
     * @return mixed[]
     */
    public function getCurrentRequestMiddleware(Request $request): array
    {
        return array_merge(
            $this->getMiddleware(),
            $this->getControllerMiddleware($request),
            $this->getRouteMiddleware($request)
        );
    }

    /**
     * 获取控制器排除中间件.
     *
     * @return mixed[]
     */
    public function getControllerExcludedMiddleware(Request $request): array
    {
        $controller = $this->getCurrentController($request);
        if (is_null($controller)) {
            return [];
        }

        return $controller->getExcludedMiddleware();
    }

    /**
     * 获取路由排除中间件.
     *
     * @return mixed[]
     */
    public function getRouteExcludedMiddleware(Request $request): array
    {
        return $this->getCurrentRoute($request)->getExcludedMiddleware();
    }

    /**
     * 获取控制器中间件.
     *
     * @return mixed[]
     */
    public function getControllerMiddleware(Request $request): array
    {
        $controller = $this->getCurrentController($request);
        if (is_null($controller)) {
            return [];
        }

        return $controller->getMiddleware();
    }

    /**
     * 获取路由中间件.
     *
     * @return mixed[]
     */
    public function getRouteMiddleware(Request $request): array
    {
        return $this->getCurrentRoute($request)->getMiddleware();
    }

    /**
     * 获取当前路由.
     */
    public function getCurrentRoute(Request $request): Route
    {
        $parameters = $this['routing.url.matcher']->matchRequest($request);

        return $this['routing.collection']->get($parameters['_route']);
    }

    /**
     * 获取当前控制器.
     */
    public function getCurrentController(Request $request): ?Controller
    {
        $parameters = $this['routing.url.matcher']->matchRequest($request);
        if (! is_array($parameters['_controller'])) {
            return null;
        }

        return $this->make($parameters['_controller'][0]);
    }

    protected function bindApp(): void
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->alias('app', self::class);
        $this->alias('app', Container::class);
    }

    protected function bindConfig(array $options): void
    {
        $this->instance(
            Config::class,
            new Config([
                'app' => array_merge(require __DIR__.'/../config/app.php', $options),
            ])
        );
        $this->alias(Config::class, 'config');

        is_null($envPath = $this->app['config']['app.env_path']) or $this->loadEnvFrom($envPath);
        is_null($configPath = $this->app['config']['app.config_path']) or $this->loadConfigFrom($configPath, true);
    }
}

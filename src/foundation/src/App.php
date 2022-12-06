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

use Coole\Console\CommandDiscoverer;
use Coole\ErrorHandler\ErrorHandlerInterface;
use Coole\Foundation\Concerns\InteractsWithController;
use Coole\Foundation\Events\ExceptionEvent;
use Coole\Foundation\Events\RequestHandledEvent;
use Coole\Foundation\Events\TerminateEvent;
use Coole\Foundation\Exceptions\UnknownFileOrDirectoryException;
use Coole\HttpKernel\Controller;
use Coole\Routing\Route;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    use InteractsWithController;
    use Macroable;
    use Tappable;

    /**
     * @var string
     */
    public const VERSION = '2.0.0-rc1';

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
        $this->bindApplication();
        $this->bindConfiguration($options);
        $this->register(new AppServiceProvider($this));
    }

    /**
     * 获取版本号.
     */
    public static function version(): string
    {
        return static::VERSION;
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
     * 注册服务.
     */
    public function register(ServiceProvider $serviceProvider): void
    {
        $this->providers[] = $serviceProvider;

        $serviceProvider->registering();

        foreach ($serviceProvider->getBindings() as $abstract => $concrete) {
            $this->bind($abstract, $concrete);
        }

        foreach ($serviceProvider->getSingletons() as $abstract => $concrete) {
            $abstract = is_int($abstract) ? $concrete : $abstract;

            $this->singleton($abstract, $concrete);
        }

        $serviceProvider->register();

        foreach ($serviceProvider->getAliases() as $abstract => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->alias($abstract, $alias);
            }
        }

        foreach ($serviceProvider->getClassAliases() as $original => $aliases) {
            if (is_int($original)) {
                class_exists($alias = class_basename($aliases)) or class_alias($aliases, $alias);

                continue;
            }

            foreach ((array) $aliases as $alias) {
                class_exists($alias) or class_alias($original, $alias);
            }
        }

        $serviceProvider->registered();
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
     * 加载命令.
     */
    public function loadCommandFrom(string $dir, string $namespace): void
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace);

        $this['console.command-collection']->push(...$commandDiscoverer->getCommands());
    }

    /**
     * 注册命令.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function commands(string|Command|array $commands): void
    {
        if (! is_array($commands)) {
            $commands = [$commands];
        }

        foreach ($commands as $command) {
            if ($command instanceof Command) {
                $this['console.command-collection']->add($command);

                continue;
            }

            $this['console.command-collection']->add($this->make($command));
        }
    }

    /**
     * 合并配置.
     */
    public function mergeConfig(array $value, string $key): void
    {
        $values = [$value, $this['config']->get($key, [])];

        if ('app' === $key) {
            $values = array_reverse($values);
        }

        $this['config']->set($key, array_merge(...$values));
    }

    /**
     * 从指定路径合并配置.
     */
    public function mergeConfigFrom(string $path, ?string $key = null): void
    {
        $this->mergeConfig(require $path, $key ?: pathinfo($path, PATHINFO_FILENAME));
    }

    /**
     * 加载配置.
     *
     * @throws \Coole\Foundation\Exceptions\UnknownFileOrDirectoryException
     */
    public function loadConfigFrom(string $path): void
    {
        if (! file_exists($path)) {
            throw UnknownFileOrDirectoryException::create($path);
        }

        $configFiles = is_dir($path)
            ? Finder::create()->depth(0)->files()->in($path)->name('*.php')
            : [new \SplFileInfo($path)];

        foreach ($configFiles as $configFile) {
            $this->mergeConfigFrom((string) $configFile);
        }
    }

    /**
     * 加载 env.
     *
     * @param string|array<string> $paths
     */
    public function loadEnvFrom(string|array $paths): void
    {
        Dotenv::createUnsafeMutable($paths)->load();
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

        $routeFiles = is_dir($path)
            ? Finder::create()->depth(0)->files()->in($path)->name('*.php')
            : [$path];

        foreach ($routeFiles as $routeFile) {
            require_once $routeFile;
        }
    }

    /**
     * 确定应用程序是否在控制台中运行.
     */
    public function runningInConsole(): bool
    {
        return (bool) (cenv('APP_RUNNING_IN_CONSOLE') ?: (\PHP_SAPI === 'cli' || \PHP_SAPI === 'phpdbg'));
    }

    /**
     * 启动运行服务.
     */
    public function run(?Request $request = null): void
    {
        try {
            // 创建请求对象
            $request or $request = Request::createFromGlobals();

            // 通过中间件将请求转化为响应
            $response = $this->sendRequestThroughPipeline($request);
        } catch (\Throwable $throwable) {
            // 触发异常事件
            $this[EventDispatcherInterface::class]->dispatch(
                new ExceptionEvent($throwable)
            );

            // 报告异常
            $this->reportException($throwable);

            // 渲染异常
            $response = $this->renderException($request, $throwable);
        }

        // 触发请求已处理事件
        $this[EventDispatcherInterface::class]->dispatch(
            new RequestHandledEvent($request, $response)
        );

        // 发送响应
        $response->send();

        // 终止请求/响应生命周期
        $this->terminate($request, $response);
    }

    /**
     * 报告异常.
     */
    protected function reportException(\Throwable $throwable): void
    {
        $this[ErrorHandlerInterface::class]->report($throwable);
    }

    /**
     * 渲染异常.
     */
    protected function renderException(Request $request, \Throwable $throwable): Response
    {
        return $this[ErrorHandlerInterface::class]->render($request, $throwable);
    }

    public function isBooted(): bool
    {
        return $this->booted;
    }

    /**
     * 通过管道发送响应.
     */
    public function sendRequestThroughPipeline(Request $request): Response
    {
        // 绑定请求
        $this->instance(Request::class, $request);
        $this->alias(Request::class, 'request');

        // 引导服务
        $this->boot();

        return (new Pipeline($this))
            ->send($request)
            ->through($this->getShouldExecutedRequestMiddleware($request))
            ->then(function ($request): Response {
                $this->instance(Request::class, $request);

                return $this->handle($request);
            });
    }

    /**
     * 处理请求为响应且发送响应.
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MAIN_REQUEST, bool $catch = true): Response
    {
        return $this[HttpKernelInterface::class]->handle($request, $type, $catch);
    }

    /**
     * 终止请求/响应生命周期.
     */
    public function terminate(Request $request, Response $response): void
    {
        $this[EventDispatcherInterface::class]->dispatch(
            new TerminateEvent($request, $response)
        );
    }

    /**
     * 获取应该被执行的请求中间件.
     *
     * @return array<string|callable>
     */
    public function getShouldExecutedRequestMiddleware(Request $request): array
    {
        $classes = array_diff(
            array_filter(
                $this->getRequestMiddleware($request),
                static fn ($middleware) => is_string($middleware)
            ),
            $this->getWithoutRequestMiddleware($request),
        );

        $objects = array_filter(
            $this->getRequestMiddleware($request),
            static fn ($middleware) => is_object($middleware)
        );

        return array_merge(array_unique($classes), $objects);
    }

    /**
     * 获取请求中间件.
     *
     * @return array<string|callable>
     */
    public function getRequestMiddleware(Request $request): array
    {
        return array_merge(
            $this->getMiddleware(),
            $this->getControllerMiddleware($request),
            $this->getRouteMiddleware($request)
        );
    }

    /**
     * 获取控制器中间件.
     *
     * @return array<string|callable>
     */
    public function getControllerMiddleware(Request $request): array
    {
        $controller = $this->getController($request);
        if (! $controller instanceof Controller) {
            return [];
        }

        return $controller->getMiddleware();
    }

    /**
     * 获取路由中间件.
     *
     * @return array<string|callable>
     */
    public function getRouteMiddleware(Request $request): array
    {
        return $this->getRoute($request)->getMiddleware();
    }

    /**
     * 获取排除的请求中间件.
     *
     * @return array<string>
     */
    public function getWithoutRequestMiddleware(Request $request): array
    {
        return array_merge(
            $this->getWithoutMiddleware(),
            $this->getWithoutControllerMiddleware($request),
            $this->getWithoutRouteMiddleware($request)
        );
    }

    /**
     * 获取排除的控制器中间件.
     *
     * @return array<string>
     */
    public function getWithoutControllerMiddleware(Request $request): array
    {
        $controller = $this->getController($request);
        if (! $controller instanceof Controller) {
            return [];
        }

        return $controller->getWithoutMiddleware();
    }

    /**
     * 获取排除的路由中间件.
     *
     * @return array<string>
     */
    public function getWithoutRouteMiddleware(Request $request): array
    {
        return $this->getRoute($request)->getWithoutMiddleware();
    }

    /**
     * 获取控制器.
     */
    public function getController(Request $request): ?Controller
    {
        $parameters = $this[UrlMatcherInterface::class]->matchRequest($request);

        // __invoke class callback
        if (is_string($parameters['_controller'])) {
            return $this->make($parameters['_controller']);
        }

        // __invoke object callback
        if (is_object($parameters['_controller']) && ! $parameters['_controller'] instanceof \Closure) {
            return $parameters['_controller'];
        }

        // array callback
        if (is_array($parameters['_controller'])) {
            return $this->make($parameters['_controller'][0]);
        }

        return null;
    }

    /**
     * 获取路由.
     */
    public function getRoute(Request $request): Route
    {
        $parameters = $this[UrlMatcherInterface::class]->matchRequest($request);

        return $this['routing.route-collection']->get($parameters['_route']);
    }

    /**
     * 绑定应用.
     */
    protected function bindApplication(): void
    {
        static::setInstance($this);
        $this->instance(self::class, $this);
        $this->alias(self::class, 'app');
        $this->bind(ContainerInterface::class, Container::class);
        $this->instance(Container::class, $this);
    }

    /**
     * 绑定配置.
     *
     * @throws \Coole\Foundation\Exceptions\UnknownFileOrDirectoryException
     */
    protected function bindConfiguration(array $options): void
    {
        $this->singleton(Config::class);
        $this->alias(Config::class, 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/app.php');
        $this->mergeConfig($options, 'app');

        null === ($envPath = $this['config']['app.env_path']) or $this->loadEnvFrom($envPath);
        null === ($configPath = $this['config']['app.config_path']) or $this->loadConfigFrom($configPath);
    }
}

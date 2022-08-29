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

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    use HasControllerAble;

    public const VERSION = '1.1.0';

    /**
     * 核心配置.
     */
    protected array $options = [
        'debug' => false,
        'charset' => 'UTF-8',
        'config_path' => null,
        'env_path' => null,
    ];

    /**
     * 核心服务.
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
        // 设置 app 共享实例
        static::setInstance($this);

        // 将 app 实例注册为在容器中共享的实例
        $this->instance('app', $this);

        // 设置核心全局配置
        $this->setOptions($options);

        // 注册 app 服务
        $this->register(new AppServiceProvider($this));
    }

    /**
     * 注册服务.
     */
    public function register(ServiceProvider $provider): void
    {
        $this->providers[] = $provider;

        $provider->registering();
        $provider->register();
        $provider->registered();
    }

    /**
     * 添加全局配置.
     */
    public function addOptions(array $options): void
    {
        $this->options = array_merge($this->options, $options);

        foreach ($this->options as $key => $option) {
            $this[$key] = $option;
        }

        $this['options'] = $this->options;
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
     * @param string|string[] $paths
     */
    public function loadEnvsFrom(string|array $paths): void
    {
        $dotenv = Dotenv::createUnsafeMutable($paths);
        $dotenv->load();
    }

    /**
     * 加载配置.
     *
     * @throws \Coole\Foundation\Exceptions\UnknownFileOrDirectoryException
     */
    public function loadConfigsFrom(string $path, bool $force = true): void
    {
        if (! file_exists($path)) {
            throw UnknownFileOrDirectoryException::create($path);
        }

        if (is_file($path)) {
            $configFiles = [new SplFileInfo($path)];
        }

        if (is_dir($path)) {
            $configFiles = Finder::create()->depth(0)->files()->in($path)->name('*.php');
        }

        foreach ($configFiles as $configFile) {
            $key = $configFile->getBasename('.php');
            $value = require $configFile->getPathname();

            $force ? $this->mergeConfig($key, $value) : $this->addConfig($key, $value);
        }
    }

    public function mergeConfigFrom(string $path, string $key)
    {
        $config = $this->app->make('config');

        $config->set($key, array_merge(
            require $path, $config->get($key, [])
        ));
    }

    /**
     * 加载路由.
     */
    public function loadRoutesFrom(string $path): void
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
    public function loadCommandsFrom(string $dir, string $namespace, string $suffix = '*Command.php'): void
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace, $suffix);

        $commands = $commandDiscoverer->getCommands() and $this['command']->add($commands);
    }

    /**
     * 设置全局配置.
     */
    public function setOptions(array $options): void
    {
        $this->addOptions($options);
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
     *
     * @return $this
     */
    public function addConfig(string $key, array $value): void
    {
        $this['config']->offsetExists($key) or $this['config'][$key] = $value;
    }

    /**
     * 批量注册服务.
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
    public function run(Request $request = null): void
    {
        if (null === $request) {
            // 创建请求对象
            $request = Request::createFromGlobals();
        }

        // 引导服务
        $this->boot();

        // 通过中间件将请求转化为响应
        $response = $this->sendRequestThroughPipeline($request);

        // 发送响应
        $response->send();

        // 终止请求/响应生命周期
        $this->terminate($request, $response);
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
            ->then(function ($request) {
                return $this->handle($request);
            });
    }

    /**
     * 处理请求为响应且发送响应.
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MAIN_REQUEST, bool $catch = true): Response
    {
        return $this['http_kernel']->handle($request, $type, $catch);
    }

    /**
     * 终止请求/响应生命周期.
     */
    public function terminate(Request $request, Response $response): void
    {
        $this['http_kernel']->terminate($request, $response);
    }

    /**
     * 批量实例化中间件.
     *
     * @param string[]|object[]|Closure[]|string $middlewares
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
     */
    public function getCurrentRequestShouldExecutedMiddleware(Request $request): array
    {
        $middlewares = $this->getCurrentRequestMiddleware($request);

        $classMiddleware = array_filter($middlewares, function ($middleware) {
            return is_string($middleware);
        });

        $objectMiddleware = array_filter($middlewares, function ($middleware) {
            return ! is_string($middleware);
        });

        return array_merge(array_diff($classMiddleware, $this->getCurrentRequestExcludedMiddleware($request)), $objectMiddleware);
    }

    /**
     * 获取当前请求排除中间件.
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
     */
    public function getRouteExcludedMiddleware(Request $request): array
    {
        return $this->getCurrentRoute($request)->getExcludedMiddleware();
    }

    /**
     * 获取控制器中间件.
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
        $parameters = $this['url_matcher']->matchRequest($request);

        return $this['route_collection']->get($parameters['_route']);
    }

    /**
     * 获取当前控制器.
     */
    public function getCurrentController(Request $request): ?Controller
    {
        $parameters = $this['url_matcher']->matchRequest($request);
        if (! is_array($parameters['_controller'])) {
            return null;
        }

        return $this->make($parameters['_controller'][0]);
    }
}

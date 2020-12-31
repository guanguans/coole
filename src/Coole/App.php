<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole;

use Dotenv\Dotenv;
use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\Console\CommandDiscoverer;
use Guanguans\Coole\Controller\ControllerAble;
use Guanguans\Coole\Exception\UnknownFileException;
use Guanguans\Coole\Provider\AppServiceProvider;
use Guanguans\Coole\Provider\ConfigServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Mpociot\Pipeline\Pipeline;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Tightenco\Collect\Support\Collection;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    use ControllerAble;

    public const VERSION = '1.0.1';

    /**
     * 核心配置.
     *
     * @var array
     */
    protected $options = [
        'debug' => false,
        'charset' => 'UTF-8',
        'config_path' => null,
        'env_path' => null,
    ];

    /**
     * 是否已经引导服务.
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * 核心服务.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * 全局中间件.
     *
     * @var array
     */
    protected $middleware = [];

    public function __construct(array $options = [])
    {
        // 设置 app 共享实例
        static::setInstance($this);

        // 将 app 实例注册为在容器中共享的实例
        $this->instance('app', $this);

        // 设置核心全局配置
        $this->setOptions($options);

        // 注册 config 服务
        $this->register(new ConfigServiceProvider());

        // 注册 app 服务
        $this->register(new AppServiceProvider());
    }

    /**
     * 注册服务.
     *
     * @return $this
     */
    public function register(ServiceProviderInterface $provider): self
    {
        $this->providers[] = $provider;

        // 处理注册之前工作
        $provider instanceof BeforeRegisterAbleProviderInterface && $provider->beforeRegister($this);

        $provider->register($this);

        // 处理注册之后工作
        $provider instanceof AfterRegisterAbleProviderInterface && $provider->afterRegister($this);

        return $this;
    }

    /**
     * 添加全局配置.
     *
     * @return $this
     */
    public function addOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);

        foreach ($this->options as $key => $option) {
            $this[$key] = $option;
        }

        return $this;
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
     *
     * @return $this
     */
    public function loadEnv($paths): self
    {
        $dotenv = Dotenv::createUnsafeMutable($paths);
        $dotenv->load();

        return $this;
    }

    /**
     * 加载配置.
     *
     * @return $this
     */
    public function loadConfig(string $path): self
    {
        if (! file_exists($path)) {
            throw new UnknownFileException(sprintf('File or directory does not exist.: %s', $path));
        }

        $config = [];

        if (is_file($path)) {
            $configFile = new \SplFileInfo($path);
            $config[$configFile->getBasename('.php')] = require $configFile->getPathname();
        }

        if (is_dir($path)) {
            $configFiles = Finder::create()->files()->in($path)->name('*.php');
            foreach ($configFiles as $configFile) {
                $config[$configFile->getBasename('.php')] = require $configFile->getPathname();
            }
        }

        $this->mergeConfig($config);

        return $this;
    }

    /**
     * 加载路由.
     *
     * @return $this
     */
    public function loadRoute(string $path): self
    {
        if (! file_exists($path)) {
            throw new UnknownFileException(sprintf('File or directory does not exist.: %s', $path));
        }

        if (is_file($path)) {
            require $path;

            return $this;
        }

        $routeFiles = Finder::create()->files()->in($path)->name('*.php');
        foreach ($routeFiles as $routeFile) {
            require $routeFile;
        }

        return $this;
    }

    /**
     * 加载命令.
     */
    public function loadCommand(string $dir, string $namespace, string $suffix = '*Command.php')
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace, $suffix);
        if ($commands = $commandDiscoverer->getCommands()) {
            $this['command']->add($commands);
        }
    }

    /**
     * 设置全局配置.
     *
     * @return $this
     */
    public function setOptions(array $options): self
    {
        return $this->addOptions($options);
    }

    /**
     * 合并配置.
     *
     * @return $this
     */
    public function mergeConfig(array $configs): self
    {
        foreach ($configs as $key => $config) {
            $this['config'][$key] = $config instanceof Collection ? $config : new Collection($config);
        }

        return $this;
    }

    /**
     * 添加配置.
     *
     * @return $this
     */
    public function addConfig(array $configs): self
    {
        foreach ($configs as $key => $config) {
            $this['config']->offsetExists($key) || $this['config'][$key] = $config instanceof Collection ? $config : new Collection($config);
        }

        return $this;
    }

    /**
     * 批量注册服务.
     *
     * @return $this
     */
    public function registerProviders(array $providers): self
    {
        foreach ($providers as $provider) {
            $this->register(new $provider());
        }

        return $this;
    }

    /**
     * 启动运行服务
     */
    public function run(Request $request = null)
    {
        if (null === $request) {
            // 创建请求对象
            $request = Request::createFromGlobals();
        }

        // 引导服务
        $this->boot();

        // 通过中间件发送响应
        $response = $this->sendRequestThroughHandle($request);

        // 终止请求/响应生命周期
        $this->terminate($request, $response);
    }

    /**
     * 引导应用程序.
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;

        foreach ($this->providers as $provider) {
            // 服务订阅事件
            $provider instanceof EventListenerAbleProviderInterface && $provider->subscribe($this, $this[EventDispatcher::class]);
            // 引导服务
            $provider instanceof BootableProviderInterface && $provider->boot($this);
        }
    }

    /**
     * 通过中间件发送响应.
     */
    public function sendRequestThroughHandle(Request $request, int $type = HttpKernelInterface::MASTER_REQUEST, bool $catch = true): Response
    {
        return (new Pipeline())
            ->send($request)
            ->through($this->makeAllMiddleware($this->getAllMiddleware($request)))
            ->then(function () use ($request, $type, $catch) {
                return $this->handle($request, $type, $catch);
            });
    }

    /**
     * 批量实例化中间件.
     *
     * @param $middleware
     */
    public function makeAllMiddleware($middleware): array
    {
        $middleware = (array) $middleware;

        array_walk($middleware, function (&$item) {
            is_string($item) && $item = $this->make($item);
        });

        return $middleware;
    }

    /**
     * 获取当前请求的全部中间件.
     */
    public function getAllMiddleware(Request $request): array
    {
        return array_merge(
            $this->middleware,
            $this->getControllerMiddleware($request),
            $this->getRouteMiddleware($request)
        );
    }

    /**
     * 获取控制器中间件.
     */
    public function getControllerMiddleware(Request $request): array
    {
        $parameters = $this['url_matcher']->matchRequest($request);

        return is_array($parameters['_controller'])
            ? $this->make($parameters['_controller'][0])->getMiddleware()
            : [];
    }

    /**
     * 获取路由中间件.
     */
    public function getRouteMiddleware(Request $request): array
    {
        $parameters = $this['url_matcher']->matchRequest($request);

        return $this['route_collection']->get($parameters['_route'])->getMiddleware();
    }

    /**
     * 处理请求为响应且发送响应.
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MASTER_REQUEST, bool $catch = true): Response
    {
        $response = $this['http_kernel']->handle($request, $type, $catch);

        $response->send();

        return $response;
    }

    /**
     * 终止请求/响应生命周期.
     */
    public function terminate(Request $request, Response $response)
    {
        $this['http_kernel']->terminate($request, $response);
    }
}

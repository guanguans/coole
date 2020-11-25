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

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\Controller\ControllerAble;
use Guanguans\Coole\Providers\AppServiceProvider;
use Guanguans\Coole\Providers\ConfigServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Mpociot\Pipeline\Pipeline;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Tightenco\Collect\Support\Collection;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    use ControllerAble;

    public const VERSION = '1.0.0-dev';

    /**
     * 核心配置.
     *
     * @var array
     */
    protected $options = [
        'debug' => false,
        'charset' => 'UTF-8',
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

        // 注册 config 服务
        $this->register(new ConfigServiceProvider());

        // 添加全局配置
        $this->addOption($options);

        // 注册 app 服务
        $this->register(new AppServiceProvider());
    }

    /**
     * 获取版本号.
     */
    public static function version(): string
    {
        return static::VERSION;
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
     * 添加全局中间件.
     *
     * @param $middleware
     *
     * @return $this
     */
    public function addMiddleware($middleware): self
    {
        $this->middleware = array_merge($this->middleware, (array) $middleware);

        return $this;
    }

    /**
     * 添加全局配置.
     *
     * @return $this
     */
    public function addOption(array $options): self
    {
        $this->options = array_merge($this->options, $options);

        foreach ($this->options as $key => $option) {
            $this[$key] = $option;
        }

        return $this;
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
     * 获取当前请求的全部中间件.
     */
    public function getAllMiddleware(Request $request): array
    {
        return array_merge(
            $this->middleware,
            $this->getControllerMiddleware($request),
            $this->getRouteMiddleware($request),
        );
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
     * 处理请求为响应且发送响应.
     */
    public function handle(Request $request, int $type = HttpKernelInterface::MASTER_REQUEST, bool $catch = true): Response
    {
        $response = $this['http_kernel']->handle($request, $type, $catch);

        $response->send();

        return $response;
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
     * 终止请求/响应生命周期.
     */
    public function terminate(Request $request, Response $response)
    {
        $this['http_kernel']->terminate($request, $response);
    }
}

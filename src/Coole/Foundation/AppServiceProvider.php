<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Foundation;

use Guanguans\Coole\Config\ConfigServiceProvider;
use Guanguans\Coole\Console\ConsoleServiceProvider;
use Guanguans\Coole\DB\DBServiceProvider;
use Guanguans\Coole\ErrorHandler\WhoopsServiceProvider;
use Guanguans\Coole\Event\EventServiceProvider;
use Guanguans\Coole\Foundation\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\Foundation\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\Foundation\Facade\Facade;
use Guanguans\Coole\Foundation\Listener\NullResponseListener;
use Guanguans\Coole\Foundation\Listener\StringResponseListener;
use Guanguans\Coole\Foundation\Middleware\CheckResponseForModifications;
use Guanguans\Coole\HttpKernel\HttpKernelServiceProvider;
use Guanguans\Coole\Invoker\InvokerServiceProvider;
use Guanguans\Coole\Log\LogServiceProvider;
use Guanguans\Coole\Routing\RoutingServiceProvider;
use Guanguans\Coole\View\ViewServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class AppServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface, EventListenerAbleProviderInterface
{
    /**
     * 核心服务
     *
     * @var string[]
     */
    protected $providers = [
        WhoopsServiceProvider::class,
        LogServiceProvider::class,
        EventServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        ConsoleServiceProvider::class,
        ViewServiceProvider::class,
        DBServiceProvider::class,
        InvokerServiceProvider::class,
    ];

    /**
     * 全局中间件.
     *
     * @var string[]
     */
    protected $middleware = [
        CheckResponseForModifications::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        // 设置门面的 app 共享实例
        Facade::setFacadeApplication($app);

        // 注册 config 服务
        $app->register(new ConfigServiceProvider());

        // 设置配置
        $this->setUpConfig($app);

        // 设置第三方全局配置
        $app->setOptions($app['config']['app']->toArray());

        // 设置 timezone
        date_default_timezone_set($app['timezone']);

        // 设置核心全局中间件
        $app->setMiddleware($this->middleware);

        // 设置第三方全局中间件
        $app->setMiddleware($app['config']['app']['middleware']);
    }

    /**
     * 设置配置.
     */
    protected function setUpConfig(App $app)
    {
        $app->addConfig([
            'app' => [
                'name' => cenv('APP_NAME', 'Coole'),
                'env' => cenv('APP_ENV', 'production'),
                'debug' => cenv('APP_DEBUG', true),
                'timezone' => 'Asia/Shanghai',
                'env_path' => base_path(),
                'config_path' => base_path('config'),
                'providers' => [],
                'middleware' => [],
                'route' => [],
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        // 注册核心服务
        $app->registerProviders($this->providers);

        // 注册第三方服务
        $app->registerProviders($app['config']['app']['providers']);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addSubscriber(new ResponseListener($app['charset']));
        $dispatcher->addSubscriber(new StringResponseListener());
        $dispatcher->addSubscriber(new NullResponseListener());
    }
}

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

use Coole\Config\ConfigServiceProvider;
use Coole\Console\ConsoleServiceProvider;
use Coole\DB\DBServiceProvider;
use Coole\ErrorHandler\ErrorHandlerServiceProvider;
use Coole\Event\EventServiceProvider;
use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\Facades\Facade;
use Coole\Foundation\Listeners\NullResponseListener;
use Coole\Foundation\Listeners\StringResponseListener;
use Coole\Foundation\Middlewares\CheckResponseForModifications;
use Coole\HttpKernel\HttpKernelServiceProvider;
use Coole\Log\LogServiceProvider;
use Coole\Routing\RoutingServiceProvider;
use Coole\View\ViewServiceProvider;
use Illuminate\Container\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 核心服务
     *
     * @var string[]
     */
    protected $providers = [
        ErrorHandlerServiceProvider::class,
        LogServiceProvider::class,
        EventServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        ConsoleServiceProvider::class,
        ViewServiceProvider::class,
        DBServiceProvider::class,
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

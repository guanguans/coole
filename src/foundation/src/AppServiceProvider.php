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
use Coole\Database\DatabaseServiceProvider;
use Coole\ErrorHandler\ErrorHandlerServiceProvider;
use Coole\Event\EventServiceProvider;
use Coole\Foundation\Listeners\NullResponseListener;
use Coole\Foundation\Listeners\StringResponseListener;
use Coole\Foundation\Middlewares\CheckResponseForModifications;
use Coole\HttpKernel\HttpKernelServiceProvider;
use Coole\Logger\LoggerServiceProvider;
use Coole\Routing\RoutingServiceProvider;
use Coole\View\ViewServiceProvider;
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
        LoggerServiceProvider::class,
        EventServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        ConsoleServiceProvider::class,
        ViewServiceProvider::class,
        DatabaseServiceProvider::class,
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
    public function registering(): void
    {
        // 设置门面的 app 共享实例
        Facade::setFacadeApplication($this->app);

        // 注册 config 服务
        $this->app->register(new ConfigServiceProvider($this->app));

        // 设置配置
        $this->app->loadConfigsFrom(__DIR__.'/../config/app.php');

        // 设置第三方全局配置
        $this->app->setOptions($this->app['config']['app']);
        $this->app->setOption('debug', true);

        // 设置 timezone
        date_default_timezone_set($this->app['timezone']);

        mb_internal_encoding('UTF-8');

        // 设置核心全局中间件
        $this->app->setMiddleware($this->middleware);

        // 设置第三方全局中间件
        $this->app->setMiddleware($this->app['config']['app']['middleware']);
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        // 注册核心服务
        $this->app->registerProviders($this->providers);

        // 注册第三方服务
        $this->app->registerProviders($this->app['config']['app']['providers']);
    }

    public function boot(): void
    {
        $this->app['event.dispatcher']->addSubscriber(new ResponseListener($this->app['charset']));
        $this->app['event.dispatcher']->addSubscriber(new StringResponseListener());
        $this->app['event.dispatcher']->addSubscriber(new NullResponseListener());
    }
}

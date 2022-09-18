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

use Coole\Console\ConsoleServiceProvider;
use Coole\Database\DatabaseServiceProvider;
use Coole\ErrorHandler\ErrorHandlerServiceProvider;
use Coole\EventDispatcher\EventServiceProvider;
use Coole\Foundation\Facades\Facade;
use Coole\Foundation\Listeners\ConverterListener;
use Coole\Foundation\Listeners\LogListener;
use Coole\Foundation\Listeners\StringToResponseListener;
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
     * @var array<string>
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
     * @var array<string>
     */
    protected $middleware = [
        CheckResponseForModifications::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $classAliases = [
        \Coole\Foundation\Facades\App::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function registering(): void
    {
        // 设置门面的 app 共享实例
        Facade::setFacadeApplication($this->app);

        // 设置时区
        date_default_timezone_set($this->app['config']['app.timezone']);

        // 设置编码
        mb_internal_encoding($this->app['config']['app.charset']);
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        // 注册核心服务
        $this->app->registerProviders($this->providers);

        // 注册第三方服务
        $this->app->registerProviders($this->app['config']['app.providers']);
    }

    /**
     * {@inheritdoc}
     */
    public function booting(): void
    {
        // 设置核心全局中间件
        $this->app->setMiddleware($this->middleware);

        // 设置第三方全局中间件
        $this->app->setMiddleware($this->app['config']['app.middleware']);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->app['event_dispatcher']->addSubscriber(new ResponseListener($this->app['config']['app.charset']));
        $this->app['event_dispatcher']->addSubscriber(new StringToResponseListener());
        $this->app['event_dispatcher']->addSubscriber($this->app->make(LogListener::class));
        $this->app['event_dispatcher']->addSubscriber($this->app->make(ConverterListener::class));
    }
}

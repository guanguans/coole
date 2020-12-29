<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Coole\Console\ConsoleServiceProvider;
use Guanguans\Coole\Database\DatabaseServiceProvider;
use Guanguans\Coole\Event\EventServiceProvider;
use Guanguans\Coole\Facade\Facade;
use Guanguans\Coole\Middleware\CheckResponseForModifications;
use Guanguans\Coole\Routing\RoutingServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface
{
    /**
     * 核心服务
     *
     * @var string[]
     */
    protected $providers = [
        WhoopsServiceProvider::class,
        MonologServiceProvider::class,
        EventServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        ConsoleServiceProvider::class,
        TwigServiceProvider::class,
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
    public function beforeRegister(App $app)
    {
        // 设置门面的 app 共享实例
        Facade::setFacadeApplication($app);

        $options = isset($app['config']['app'])
            ? $app['config']['app']->filter(function ($value) {
                return ! is_array($value);
            })->toArray()
            : [];

        // 设置选项
        $app->setOptions($options);

        // 设置中间件
        $app->setMiddleware($this->middleware);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        // 注册核心服务
        $app->registerProviders($this->providers);

        // 注册第三方服务
        $app->registerProviders($app['config']['app']['providers'] ?? []);
    }
}

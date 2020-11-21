<?php

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
     * 核心服务服务类.
     *
     * @var string[]
     */
    protected $providers = [
        WhoopsServiceProvider::class,
        EventServiceProvider::class,
        HttpFoundationServiceProvider::class,
        RoutingServiceProvider::class,
        MonologServiceProvider::class,
        HttpKernelServiceProvider::class,
        DatabaseServiceProvider::class,
        TwigServiceProvider::class,
        ConsoleServiceProvider::class,
    ];

    /**
     * 核心中间件类.
     *
     * @var string[]
     */
    protected $middleware = [
        CheckResponseForModifications::class,
    ];

    public function beforeRegister(App $app)
    {
        Facade::setFacadeApplication($app);

        $options = isset($app['config']['app'])
            ? $app['config']['app']->filter(function ($value) {
                return ! is_array($value);
            })->toArray()
            : [];

        $app->addOption($options);

        $app->addMiddleware($this->middleware);
    }

    public function register(Container $app)
    {
        $app->registerProviders($this->providers);

        $app->registerProviders($app['config']['app']['providers'] ?? []);
    }
}

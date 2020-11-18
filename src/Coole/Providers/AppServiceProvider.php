<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\Able\LoadCommandAble;
use Guanguans\Coole\App;
use Guanguans\Coole\Database\DatabaseServiceProvider;
use Guanguans\Coole\Facade\Facade;
use Guanguans\Coole\Middleware\CheckResponseForModifications;
use Guanguans\Coole\Routing\RoutingServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface, AfterRegisterAbleProviderInterface
{
    use LoadCommandAble;

    /**
     * 核心服务服务类.
     *
     * @var string[]
     */
    protected $providers = [
        CommandServiceProvider::class,
        EventDispatcherServiceProvider::class,
        HttpFoundationServiceProvider::class,
        RoutingServiceProvider::class,
        MonologServiceProvider::class,
        HttpKernelServiceProvider::class,
        WhoopsServiceProvider::class,
        DoctrineServiceProvider::class,
        DatabaseServiceProvider::class,
    ];

    /**
     * 核心中间件类.
     *
     * @var string[]
     */
    protected $middlewares = [
        CheckResponseForModifications::class,
    ];

    /**
     * app 配置.
     *
     * @var array
     */
    protected $options = [
        'debug' => false,
        'charset' => 'UTF-8',
    ];

    public function beforeRegister(App $app)
    {
        foreach ($this->options as $key => $option) {
            $app[$key] = $option;
        }

        $app->addMiddleware($this->middlewares);
    }

    public function register(Container $app)
    {
        $app->registerProviders($this->providers);
    }

    public function afterRegister(App $app)
    {
        Facade::setFacadeApplication($app);

        $this->loadCommand(__DIR__.'/../Console/Commands', '\Guanguans\Coole\Console\Commands');
    }
}

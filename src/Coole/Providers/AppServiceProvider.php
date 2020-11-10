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
        ConfigServiceProvider::class,
        EventDispatcherServiceProvider::class,
        HttpFoundationServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        WhoopsServiceProvider::class,
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
}

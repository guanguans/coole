<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\HttpKernel\HttpKernelServiceProvider;
use Guanguans\Coole\Routing\RoutingServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface
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
     * 核心配置.
     *
     * @var array
     */
    protected $options = [
        'debug' => false,
        'charset' => 'UTF-8',
    ];

    public function register(Container $app)
    {
        $app->registerProviders($this->providers);

        foreach ($this->options as $key => $option) {
            $app[$key] = $option;
        }
    }
}

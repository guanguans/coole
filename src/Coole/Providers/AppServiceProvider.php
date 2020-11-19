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
        WhoopsServiceProvider::class,
        CommandServiceProvider::class,
        EventDispatcherServiceProvider::class,
        HttpFoundationServiceProvider::class,
        RoutingServiceProvider::class,
        MonologServiceProvider::class,
        HttpKernelServiceProvider::class,
        DoctrineServiceProvider::class,
        DatabaseServiceProvider::class,
        TwigServiceProvider::class,
    ];

    /**
     * 核心中间件类.
     *
     * @var string[]
     */
    protected $middleware = [
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

    /**
     * AppServiceProvider constructor.
     */
    public function __construct(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    public function beforeRegister(App $app)
    {
        foreach ($this->options as $key => $option) {
            $app[$key] = $option;
        }

        if (! isset($app['config']['app'])) {
            return;
        }

        $app['config']['app']->filter(function ($value, $key) {
            return ! is_array($value);
        })->each(function ($value, $key) use ($app) {
            $app[$key] = $value;
        });
    }

    public function register(Container $app)
    {
        $app->registerProviders($this->providers);

        if (isset($app['config']['app']['providers'])) {
            $app->registerProviders($app['config']['app']['providers']);
        }
    }

    public function afterRegister(App $app)
    {
        Facade::setFacadeApplication($app);

        if (isset($app['config']['app']['route'])) {
            foreach ($app['config']['app']['route'] as $file) {
                if (file_exists($file)) {
                    require $file;
                }
            }
        }

        $app->addMiddleware($this->middleware);
        if (isset($app['config']['app']['middleware'])) {
            $app->addMiddleware($app['config']['app']['middleware']);
        }

        $this->loadCommand(__DIR__.'/../Console/Commands', '\Guanguans\Coole\Console\Commands');
    }
}

<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole;

use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\Config\Config;
use Guanguans\Coole\Config\ConfigServiceProvider;
use Guanguans\Coole\HttpKernel\HttpKernelServiceProvider;
use Guanguans\Coole\Providers\AppServiceProvider;
use Guanguans\Coole\Providers\EventDispatcherServiceProvider;
use Guanguans\Coole\Providers\HttpFoundationServiceProvider;
use Guanguans\Coole\Providers\WhoopsServiceProvider;
use Guanguans\Coole\Routing\RoutingServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    public const VERSION = '1.0.0-dev';

    /**
     * 核心服务
     *
     * @var string[]
     */
    protected $providers = [
        ConfigServiceProvider::class,
        AppServiceProvider::class,
        EventDispatcherServiceProvider::class,
        HttpFoundationServiceProvider::class,
        RoutingServiceProvider::class,
        HttpKernelServiceProvider::class,
        WhoopsServiceProvider::class,
    ];

    /**
     * App constructor.
     */
    public function __construct(array $config = [])
    {
        Coole::$app = $this;

        static::setInstance($this);

        $this->instance('app', $this);

        $this->instance(Container::class, $this);

        $this->registerProviders($this->providers);

        $this->config($config);
    }

    public function version()
    {
        return static::VERSION;
    }

    public function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this['config'];
        }

        if (is_array($key)) {
            return $this['config']->set($key);
        }

        return $this['config']->get($key, $default);
    }

    public function register(ServiceProviderInterface $provider)
    {
        if ($provider instanceof BootAbleProviderInterface) {
            $provider->boot($this);
        }

        $provider->register($this);

        if ($provider instanceof EventListenerAbleProviderInterface) {
            $provider->subscribe($this, $this[EventDispatcher::class]);
        }
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->register(new $provider());
        }
    }

    public function run(Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }

        $response = $this->handle($request);
        $response->send();
        $this->terminate($request, $response);
    }

    public function handle(Request $request, int $type = self::MASTER_REQUEST, bool $catch = true)
    {
        return $this['http_kernel']->handle($request, $type, $catch);
    }

    public function terminate(Request $request, Response $response)
    {
        return $this['http_kernel']->terminate($request, $response);
    }
}

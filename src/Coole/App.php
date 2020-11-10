<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\Providers\AppServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Tightenco\Collect\Support\Collection;

class App extends Container implements HttpKernelInterface, TerminableInterface
{
    public const VERSION = '1.0.0-dev';

    protected $booted = false;

    /**
     * 核心服务
     *
     * @var array
     */
    protected $providers = [];

    /**
     * App constructor.
     */
    public function __construct(array $config = [])
    {
        static::setInstance($this);

        $this->instance('app', $this);

        $this->register(new AppServiceProvider());

        $this->addConfig($config);
    }

    public function version()
    {
        return static::VERSION;
    }

    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;

        foreach ($this->providers as $provider) {
            if ($provider instanceof EventListenerAbleProviderInterface) {
                $provider->subscribe($this, $this[EventDispatcher::class]);
            }

            if ($provider instanceof BootableProviderInterface) {
                $provider->boot($this);
            }
        }
    }

    public function mergeConfig(array $configs)
    {
        foreach ($configs as $key => $config) {
            $this['config'][$key] = $config instanceof Collection ? $config : new Collection($config);
        }
    }

    public function addConfig(array $values)
    {
        foreach ($values as $key => $config) {
            $this['config']->offsetExists($key) || $this['config'][$key] = $config instanceof Collection ? $config : new Collection($config);
        }
    }

    public function register(ServiceProviderInterface $provider)
    {
        $this->providers[] = $provider;

        if ($provider instanceof BeforeRegisterAbleProviderInterface) {
            $provider->beforeRegister($this);
        }

        $provider->register($this);

        if ($provider instanceof AfterRegisterAbleProviderInterface) {
            $provider->afterRegister($this);
        }

        return $this;
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
        $this->boot();

        return $this['http_kernel']->handle($request, $type, $catch);
    }

    public function terminate(Request $request, Response $response)
    {
        return $this['http_kernel']->terminate($request, $response);
    }
}

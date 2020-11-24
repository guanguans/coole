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

use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Coole\Controller\ControllerResolver;
use Guanguans\Coole\Listeners\NullResponseListener;
use Guanguans\Coole\Listeners\StringResponseListener;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\HttpKernel;

class HttpKernelServiceProvider implements ServiceProviderInterface, EventListenerAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(RequestStack::class, function ($app) {
            return new RequestStack();
        });
        $app->alias(RequestStack::class, 'request_stack');

        $app->singleton(ControllerResolver::class, function ($app) {
            return new ControllerResolver(app('logger'));
        });
        $app->alias(ControllerResolver::class, 'controller_resolver');

        $app->singleton(ArgumentResolver::class, function ($app) {
            return new ArgumentResolver();
        });
        $app->alias(ArgumentResolver::class, 'argument_resolver');

        $app->singleton(HttpKernel::class, function ($app) {
            return new HttpKernel($app['event_dispatcher'], $app['controller_resolver'], $app['request_stack'], $app['argument_resolver']);
        });
        $app->alias(HttpKernel::class, 'http_kernel');
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addSubscriber(new ResponseListener($app['charset']));
        $dispatcher->addSubscriber(new StringResponseListener());
        $dispatcher->addSubscriber(new NullResponseListener());
    }
}

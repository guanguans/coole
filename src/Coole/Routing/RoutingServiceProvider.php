<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Routing;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\EventListenerAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RoutingServiceProvider implements ServiceProviderInterface, EventListenerAbleProviderInterface, AfterRegisterAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(RouteCollection::class, function ($app) {
            return new RouteCollection();
        });
        $app->alias(RouteCollection::class, 'route_collection');

        $app->singleton(RequestContext::class, function ($app) {
            return new RequestContext();
        });
        $app->alias(RequestContext::class, 'request_context');

        $app->singleton(UrlMatcher::class, function ($app) {
            return new UrlMatcher($app['route_collection'], $app['request_context']);
        });
        $app->alias(UrlMatcher::class, 'url_matcher');

        $app->singleton(Router::class, function ($app) {
            return new Router(new Route(), $app['route_collection']);
        });
        $app->alias(Router::class, 'router');
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addSubscriber(new RouterListener($app['url_matcher'], $app['request_stack']));
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        if (isset($app['route'])) {
            foreach ($app['route'] as $file) {
                $app->loadRoute($file);
            }
        }
    }
}

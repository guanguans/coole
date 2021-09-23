<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing;

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Guanguans\Di\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RoutingServiceProvider extends ServiceProvider
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
        foreach ($app['route'] as $file) {
            $app->loadRoute($file);
        }
    }
}

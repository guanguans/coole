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

use Coole\Foundation\ServiceProvider;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RoutingServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(RouteCollection::class, function ($app) {
            return new RouteCollection();
        });
        $this->app->alias(RouteCollection::class, 'route_collection');

        $this->app->singleton(RequestContext::class, function ($app) {
            return new RequestContext();
        });
        $this->app->alias(RequestContext::class, 'request_context');

        $this->app->singleton(UrlMatcher::class, function ($app) {
            return new UrlMatcher($app['route_collection'], $app['request_context']);
        });
        $this->app->alias(UrlMatcher::class, 'url_matcher');

        $this->app->singleton(Router::class, function ($app) {
            return new Router(new Route(), $app['route_collection']);
        });
        $this->app->alias(Router::class, 'router');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        foreach ($this->app['route_paths'] as $file) {
            $this->app->loadRoutesFrom($file);
        }
    }

    public function boot(): void
    {
        $this->app['event.dispatcher']->addSubscriber(new RouterListener($this->app['url_matcher'], $this->app['request_stack']));
    }
}

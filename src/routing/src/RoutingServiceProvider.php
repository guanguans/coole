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

use Coole\Foundation\App;
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
        $this->app->singleton(RouteCollection::class);
        $this->app->alias(RouteCollection::class, 'routing.route_collection');

        $this->app->singleton(RequestContext::class);
        $this->app->alias(RequestContext::class, 'routing.request_context');

        $this->app->singleton(UrlMatcher::class, static fn (App $app): UrlMatcher => new UrlMatcher($app['routing.route_collection'], $app['routing.request_context']));
        $this->app->alias(UrlMatcher::class, 'routing.url_matcher');

        $this->app->singleton(Router::class, static fn (App $app): Router => new Router(new Route(), $app['routing.route_collection']));
        $this->app->alias(Router::class, 'router');
        $this->app->alias(Router::class, 'routing.router');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        foreach ($this->app['config']['app.route_paths'] as $path) {
            $this->app->loadRouteFrom($path);
        }
    }

    public function boot(): void
    {
        $this->app['event.dispatcher']->addSubscriber(
            new RouterListener($this->app['routing.url_matcher'], $this->app['http_kernel.request_stack'])
        );
    }
}

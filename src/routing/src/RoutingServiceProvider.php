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
        $this->app->singleton(RouteCollection::class);
        $this->app->alias(RouteCollection::class, 'routing.collection');

        $this->app->singleton(RequestContext::class);
        $this->app->alias(RequestContext::class, 'routing.request.context');

        $this->app->singleton(UrlMatcher::class, function ($app) {
            return new UrlMatcher($app['routing.collection'], $app['routing.request.context']);
        });
        $this->app->alias(UrlMatcher::class, 'routing.url.matcher');

        $this->app->singleton(Router::class, function ($app) {
            return new Router(new Route(), $app['routing.collection']);
        });
        $this->app->alias(Router::class, 'router');
        $this->app->alias(Router::class, 'routing.router');
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
        $this->app['event.dispatcher']->addSubscriber(new RouterListener($this->app['routing.url.matcher'], $this->app['http.kernel.request.stack']));
    }
}

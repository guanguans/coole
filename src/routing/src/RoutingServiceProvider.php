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
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class RoutingServiceProvider extends ServiceProvider
{
    protected array $bindings = [
        UrlMatcherInterface::class => UrlMatcher::class,
        RequestMatcherInterface::class => UrlMatcher::class,
    ];

    protected array $singletons = [
        RouteCollection::class,
        RequestContext::class,
        Router::class,
        UrlMatcher::class,
    ];

    protected array $aliases = [
        RouteCollection::class => ['routing.route-collection'],
        RequestContext::class => ['routing.request-context'],
        Router::class => ['routing.router', 'router'],
        UrlMatcher::class => ['routing.url-matcher'],
    ];

    protected array $classAliases = [
        \Coole\Routing\Facades\Router::class,
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/routing.php');
    }

    public function boot(): void
    {
        foreach ((array) $this->app['config']['routing.paths'] as $path) {
            $this->app->loadRouteFrom($path);
        }

        $this->app['event-dispatcher']->addSubscriber(
            $this->app->make(RouterListener::class, [
                'matcher' => $this->app[UrlMatcherInterface::class],
            ])
        );
    }
}

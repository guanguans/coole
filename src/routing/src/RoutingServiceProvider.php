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
    /**
     * {@inheritdoc}
     */
    protected array $bindings = [
        UrlMatcherInterface::class => UrlMatcher::class,
        RequestMatcherInterface::class => UrlMatcher::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        RouteCollection::class,
        RequestContext::class,
        Router::class,
        UrlMatcher::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        RouteCollection::class => ['routing.route_collection'],
        RequestContext::class => ['routing.request_context'],
        Router::class => ['routing.router', 'router'],
    ];

    /**
     * {@inheritdoc}
     */
    protected array $classAliases = [
        \Coole\Routing\Facades\Router::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/routing.php');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        foreach ($this->app['config']['routing.paths'] as $path) {
            $this->app->loadRouteFrom($path);
        }

        $this->app['event_dispatcher']->addSubscriber(
            $this->app->make(RouterListener::class, [
                'matcher' => $this->app[UrlMatcherInterface::class],
            ])
        );
    }
}

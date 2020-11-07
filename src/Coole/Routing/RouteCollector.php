<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Routing;

use Symfony\Component\Routing\RouteCollection;

class RouteCollector
{
    protected $defaultRoute;

    protected $routeCollection;

    public function __construct(Route $defaultRoute, RouteCollection $routeCollection)
    {
        $this->defaultRoute = $defaultRoute;
        $this->routeCollection = $routeCollection;
    }

    public function match($pattern, $to = null)
    {
        $route = clone $this->defaultRoute;

        $route->setPath($pattern);

        $route->setDefault('_controller', $to);

        $this->routeCollection->add($pattern, $route);

        return $route;
    }

    public function any($pattern, $to = null)
    {
        return $this->match($pattern, $to);
    }

    public function get($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('GET');
    }

    public function post($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('POST');
    }

    public function put($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('PUT');
    }

    public function delete($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('DELETE');
    }

    public function options($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('OPTIONS');
    }

    public function patch($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods('PATCH');
    }

    // public function prefix($prefix, callable $callback)
    // {
    //     $callback();
    //
    //     $this->routeCollection->addPrefix($prefix);
    //
    //     $this->routeCollection->addNamePrefix($prefix);
    //
    //     $rootCollection = new RouteCollection();
    //
    //     $rootCollection->addCollection($this->routeCollection);
    //
    //     return $this->routeCollection;
    // }
}

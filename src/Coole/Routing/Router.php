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

class Router
{
    protected $defaultRoute;

    protected $routeCollection;

    protected $groupStack = [];

    public function __construct(Route $defaultRoute, RouteCollection $routeCollection)
    {
        $this->defaultRoute = $defaultRoute;
        $this->routeCollection = $routeCollection;
    }

    public function match($pattern, $to = null)
    {
        $route = clone $this->defaultRoute;

        $route->setPath($groupPattern = $this->getGroupPattern($pattern));

        $route->setDefault('_controller', $to);

        $this->routeCollection->add($groupPattern, $route);

        return $route;
    }

    public function any($pattern, $to = null)
    {
        return $this->match($pattern, $to);
    }

    public function get($pattern, $to = null)
    {
        return $this->match($pattern, $to)->setMethods(['GET', 'HEAD']);
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

    protected function getGroupPattern($pattern)
    {
        if (empty($this->groupStack)) {
            return $pattern;
        }

        $attributes = end($this->groupStack);

        return isset($attributes['prefix']) ? rtrim($attributes['prefix'], '/').'/'.$pattern : $pattern;
    }

    protected function updateGroupStack(array $attributes)
    {
        $newAttributes = [];

        $lastAttribute = end($this->groupStack);

        $newAttributes['prefix'] =
            isset($lastAttribute['prefix'])
            ? ($lastAttribute['prefix'].(isset($attributes['prefix']) ? '/'.$attributes['prefix'] : ''))
            : ($attributes['prefix'] ?? '');

        $this->groupStack[] = $newAttributes;

        return true;
    }

    public function group($attributes, callable $callback)
    {
        // 添加组属性
        $this->updateGroupStack($attributes);

        // 利用组属性
        $callback();

        // 释放组属性
        array_pop($this->groupStack);
    }

    public function __call($name, $arguments)
    {
        return (new RouteRegistrar($this))->$name($arguments[0]);
    }
}

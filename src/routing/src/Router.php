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

use Symfony\Component\Routing\RouteCollection;

class Router
{
    /**
     * 默认路由.
     *
     * @var \Coole\Routing\Route
     */
    protected $defaultRoute;

    /**
     * 路由集合.
     *
     * @var \Symfony\Component\Routing\RouteCollection
     */
    protected $routeCollection;

    /**
     * 路由组属性栈.
     *
     * @var array
     */
    protected $groupStack = [];

    public function __construct(Route $defaultRoute, RouteCollection $routeCollection)
    {
        $this->defaultRoute = $defaultRoute;
        $this->routeCollection = $routeCollection;
    }

    /**
     * 添加任意请求路由.
     *
     * @param string|string[] $methods
     * @param null            $to
     *
     * @return \Coole\Routing\Route
     */
    public function match($methods, string $pattern, $to = null): Route
    {
        $route = clone $this->defaultRoute;

        $route->setPath($groupPattern = $this->getGroupPattern($pattern));

        $route->setDefault('_controller', $to);

        $route->setMiddleware($this->getGroupMiddleware());

        $route->setMethods($methods);

        $this->routeCollection->add($groupPattern, $route);

        return $route;
    }

    /**
     * 添加任意请求路由.
     *
     * @param string|string[] $methods
     * @param null            $to
     *
     * @return \Coole\Routing\Route
     */
    public function any($methods, string $pattern, $to = null): Route
    {
        return $this->match($methods, $pattern, $to);
    }

    /**
     * 添加 get 求路由.
     *
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function get(string $pattern, $to = null): Route
    {
        return $this->match(['GET', 'HEAD'], $pattern, $to);
    }

    /**
     * 添加 post 请求路由.
     *
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function post(string $pattern, $to = null): Route
    {
        return $this->match('POST', $pattern, $to);
    }

    /**
     * 添加 put 请求路由.
     *
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function put(string $pattern, $to = null): Route
    {
        return $this->match('PUT', $pattern, $to);
    }

    /**
     * 添加 delete 请求路由.
     *
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function delete(string $pattern, $to = null): Route
    {
        return $this->match('DELETE', $pattern, $to);
    }

    /**
     * 添加 options 请求路由.
     *
     * @param $pattern
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function options(string $pattern, $to = null): Route
    {
        return $this->match('OPTIONS', $pattern, $to);
    }

    /**
     * 添加 patch 请求路由.
     *
     * @param null $to
     *
     * @return \Coole\Routing\Route
     */
    public function patch(string $pattern, $to = null): Route
    {
        return $this->match('PATCH', $pattern, $to);
    }

    /**
     * 获取路由组 pattern.
     *
     * @param $pattern
     */
    protected function getGroupPattern(string $pattern): string
    {
        return trim(trim(end($this->groupStack)['prefix'] ?? '', '/').'/'.trim($pattern, '/'), '/');
    }

    /**
     * 获取路由组中间件.
     */
    protected function getGroupMiddleware(): array
    {
        return end($this->groupStack)['middleware'] ?? [];
    }

    /**
     * 更新路由组栈.
     *
     * @return bool
     */
    protected function updateGroupStack(array $attributes)
    {
        $lastAttribute = end($this->groupStack);

        $newAttributes = [];

        $newAttributes['prefix'] = trim(trim($lastAttribute['prefix'] ?? '', '/').'/'.trim($attributes['prefix'] ?? '', '/'), '/');

        $newAttributes['middleware'] = array_merge($lastAttribute['middleware'] ?? [], $attributes['middleware'] ?? []);

        $this->groupStack[] = $newAttributes;

        return true;
    }

    /**
     * 路由组.
     *
     * @return $this
     */
    public function group(array $attributes, callable $callback): self
    {
        // 添加组属性
        $this->updateGroupStack($attributes);

        $callback();

        // 释放组属性
        array_pop($this->groupStack);

        return $this;
    }

    /**
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return (new RouteRegistrar($this))->$name($arguments[0]);
    }
}

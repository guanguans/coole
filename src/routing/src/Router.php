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

/**
 * @mixin \Coole\Routing\RouteRegistrar
 */
class Router
{
    protected array $groupStack = [];

    protected static array $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    public function __construct(
        protected Route $defaultRoute,
        protected RouteCollection $routeCollection
    ) {
    }

    /**
     * 注册给定请求路由.
     */
    public function match(string|array $methods, string $pattern, mixed $action): Route
    {
        $route = clone $this->defaultRoute;

        $route->setPath($groupPattern = $this->getGroupPattern($pattern));

        $route->setDefault('_controller', $action);

        $route->setMiddleware($this->getGroupMiddleware());

        $route->setMethods($methods);

        $this->routeCollection->add($groupPattern, $route);

        return $route;
    }

    /**
     * 注册任意请求路由.
     */
    public function any(string $pattern, mixed $action): Route
    {
        return $this->match(self::$verbs, $pattern, $action);
    }

    /**
     * 注册 GET 求路由.
     */
    public function get(string $pattern, mixed $action): Route
    {
        return $this->match(['GET', 'HEAD'], $pattern, $action);
    }

    /**
     * 注册 POST 请求路由.
     */
    public function post(string $pattern, mixed $action): Route
    {
        return $this->match('POST', $pattern, $action);
    }

    /**
     * 注册 PUT 请求路由.
     */
    public function put(string $pattern, mixed $action): Route
    {
        return $this->match('PUT', $pattern, $action);
    }

    /**
     * 注册 DELETE 请求路由.
     */
    public function delete(string $pattern, mixed $action): Route
    {
        return $this->match('DELETE', $pattern, $action);
    }

    /**
     * 注册 OPTIONS 请求路由.
     */
    public function options(string $pattern, mixed $action): Route
    {
        return $this->match('OPTIONS', $pattern, $action);
    }

    /**
     * 注册 PATCH 请求路由.
     */
    public function patch(string $pattern, mixed $action): Route
    {
        return $this->match('PATCH', $pattern, $action);
    }

    /**
     * 获取路由组 pattern.
     */
    protected function getGroupPattern(string $pattern): string
    {
        return trim(trim(end($this->groupStack)['prefix'] ?? '', '/').'/'.trim($pattern, '/'), '/');
    }

    /**
     * 获取路由组中间件.
     *
     * @return mixed[]
     */
    protected function getGroupMiddleware(): array
    {
        return end($this->groupStack)['middleware'] ?? [];
    }

    /**
     * 更新路由组栈.
     *
     * @param array<string, mixed> $attributes
     */
    protected function updateGroupStack(array $attributes): bool
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

        call_user_func($callback);

        // 释放组属性
        array_pop($this->groupStack);

        return $this;
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return (new RouteRegistrar($this))->$name($arguments[0]);
    }
}

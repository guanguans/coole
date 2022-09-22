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
    /**
     * @var array<array<string, mixed>>
     */
    protected array $groupStack = [];

    /**
     * @var array<string>
     */
    protected static array $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    public function __construct(
        protected Route $defaultRoute,
        protected RouteCollection $routeCollection
    ) {
    }

    /**
     * 注册给定请求路由.
     */
    public function match(string|array $methods, string $uri, mixed $action): Route
    {
        $route = clone $this->defaultRoute;

        $route->setPath($path = $this->extractPath($uri));
        $route->setDefault('_controller', $action);
        $route->setMethods($methods);
        $route->setMiddleware($this->extractMiddleware());
        $route->name($this->extractName());
        $route->setWithoutMiddleware($this->extractWithoutMiddleware());

        $this->routeCollection->add($path, $route);

        return $route;
    }

    /**
     * 注册任意请求路由.
     */
    public function any(string $uri, mixed $action): Route
    {
        return $this->match(self::$verbs, $uri, $action);
    }

    /**
     * 注册 GET 求路由.
     */
    public function get(string $uri, mixed $action): Route
    {
        return $this->match(['GET', 'HEAD'], $uri, $action);
    }

    /**
     * 注册 POST 请求路由.
     */
    public function post(string $uri, mixed $action): Route
    {
        return $this->match('POST', $uri, $action);
    }

    /**
     * 注册 PUT 请求路由.
     */
    public function put(string $uri, mixed $action): Route
    {
        return $this->match('PUT', $uri, $action);
    }

    /**
     * 注册 DELETE 请求路由.
     */
    public function delete(string $uri, mixed $action): Route
    {
        return $this->match('DELETE', $uri, $action);
    }

    /**
     * 注册 OPTIONS 请求路由.
     */
    public function options(string $uri, mixed $action): Route
    {
        return $this->match('OPTIONS', $uri, $action);
    }

    /**
     * 注册 PATCH 请求路由.
     */
    public function patch(string $uri, mixed $action): Route
    {
        return $this->match('PATCH', $uri, $action);
    }

    /**
     * 提取路径.
     */
    protected function extractPath(string $uri): string
    {
        return trim(
            trim(trim(end($this->groupStack)['prefix'] ?? ''), '/').'/'.trim(trim($uri), '/'),
            '/'
        ) ?: '/';
    }

    /**
     * 提取中间件.
     *
     * @return array<string|callable>
     */
    protected function extractMiddleware(): array
    {
        return end($this->groupStack)['middleware'] ?? [];
    }

    /**
     * 提取名称.
     */
    protected function extractName(): string
    {
        return end($this->groupStack)['as'] ?? '';
    }

    /**
     * 提取排除的中间件.
     *
     * @return array<class-string>
     */
    protected function extractWithoutMiddleware(): array
    {
        return end($this->groupStack)['without_middleware'] ?? [];
    }

    /**
     * 更新路由组栈.
     *
     * @param array<string, mixed> $attributes
     */
    protected function updateGroupStack(array $attributes): void
    {
        $lastAttributes = end($this->groupStack);

        $newAttributes = [];

        $newAttributes['as'] = ($lastAttributes['as'] ?? '').($attributes['as'] ?? '');

        $newAttributes['middleware'] = array_merge(
            $lastAttributes['middleware'] ?? [],
            $attributes['middleware'] ?? []
        );

        $newAttributes['prefix'] = trim(trim($lastAttributes['prefix'] ?? ''), '/').'/'.
                                   trim(trim($attributes['prefix'] ?? ''), '/');

        $newAttributes['without_middleware'] = array_merge(
            $lastAttributes['without_middleware'] ?? [],
            $attributes['without_middleware'] ?? []
        );

        $this->groupStack[] = $newAttributes;
    }

    /**
     * 路由组.
     *
     * * @param array<string, mixed> $attributes
     *
     * @return $this
     */
    public function group(array $attributes, callable $callback): self
    {
        // 添加路由组属性
        $this->updateGroupStack($attributes);

        // 注册子路由
        $callback($this);

        // 释放路由组属性
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

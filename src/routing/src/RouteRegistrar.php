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

use Illuminate\Support\Arr;

/**
 * @method \Coole\Routing\Route          get(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          post(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          put(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          delete(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          patch(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          options(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\Route          any(string $uri, \Closure|array|string|callable $action)
 * @method \Coole\Routing\RouteRegistrar as(string $name)
 * @method \Coole\Routing\RouteRegistrar middleware(string|callable|array $middleware)
 * @method \Coole\Routing\RouteRegistrar name(string $name)
 * @method \Coole\Routing\RouteRegistrar prefix(string $prefix)
 * @method \Coole\Routing\RouteRegistrar withoutMiddleware(string|array $middleware)
 */
class RouteRegistrar
{
    /**
     * 路由组属性.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [];

    /**
     * 动态传递给路由器的方法.
     *
     * @var array<string>
     */
    protected $passthru = [
        'get', 'post', 'put', 'patch', 'delete', 'options', 'any',
    ];

    /**
     * 允许设置的属性.
     *
     * @var array<string>
     */
    protected $allowedAttributes = [
        'as',
        'middleware',
        'name',
        'prefix',
        'withoutMiddleware',
    ];

    /**
     * 属性的别名.
     *
     * @var array
     */
    protected $aliases = [
        'name' => 'as',
        'withoutMiddleware' => 'excluded_middleware',
    ];

    public function __construct(protected Router $router)
    {
    }

    /**
     * 设置给定属性的值.
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function attribute(string $key, mixed $value): static
    {
        if (! in_array($key, $this->allowedAttributes, true)) {
            throw new \InvalidArgumentException("Attribute [$key] does not exist.");
        }

        if ('middleware' === $key || 'withoutMiddleware' === $key) {
            $value = Arr::wrap($value);
        }

        $attributeKey = Arr::get($this->aliases, $key, $key);

        $this->attributes[$attributeKey] = $value;

        return $this;
    }

    /**
     * 路由组.
     */
    public function group(callable $callback): void
    {
        $this->router->group($this->attributes, $callback);
    }

    /**
     * 用给定的动词注册一条新路线.
     */
    public function match(string|array $methods, string $uri, \Closure|array|string|callable $action): Route
    {
        return $this->router->match($methods, $uri, $action);
    }

    /**
     * 向路由器注册新路由.
     */
    protected function registerRoute(string $method, string $uri, \Closure|array|string|callable $action): Route
    {
        return $this->router->{$method}($uri, $action);
    }

    /**
     * 动态处理对路由注册器的调用.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return \Coole\Routing\Route|$this
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters): Route|static
    {
        if (in_array($method, $this->passthru, true)) {
            return $this->registerRoute($method, ...$parameters);
        }

        if (in_array($method, $this->allowedAttributes, true)) {
            if ('middleware' === $method || 'withoutMiddleware' === $method) {
                return $this->attribute($method, is_array($parameters[0]) ? $parameters[0] : $parameters);
            }

            return $this->attribute($method, array_key_exists(0, $parameters) ? $parameters[0] : true);
        }

        throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $method));
    }
}

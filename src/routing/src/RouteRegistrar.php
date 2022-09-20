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
use InvalidArgumentException;

class RouteRegistrar
{
    /**
     * 路由组属性.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [];

    /**
     * 允许设置的属性.
     *
     * @var array<string>
     */
    protected $allowedAttributes = [
        'prefix',
        'middleware',
        'without_middleware',
    ];

    public function __construct(protected Router $router)
    {
    }

    /**
     * 路由组前缀
     *
     * @return $this
     */
    public function prefix(string $prefix): self
    {
        return $this->attribute('prefix', $prefix);
    }

    /**
     * 路由组中间件.
     *
     * @param string|callable|array<string|callable> $middleware
     *
     * @return $this
     */
    public function middleware(string|callable|array $middleware): self
    {
        return $this->attribute('middleware', $middleware);
    }

    /**
     * 路由组排除的中间件.
     *
     * @param string|array<string> $middleware
     *
     * @return $this
     */
    public function withoutMiddleware(string|array $middleware): self
    {
        return $this->attribute('without_middleware', $middleware);
    }

    /**
     * Set the value for a given attribute.
     *
     * @param mixed $value
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function attribute(string $key, $value)
    {
        if (! in_array($key, $this->allowedAttributes)) {
            throw new InvalidArgumentException("Attribute [$key] does not exist.");
        }

        if ('middleware' === $key) {
            $value = Arr::wrap($value);
        }

        if ('without_middleware' === $key) {
            $value = array_merge(
                (array) ($this->attributes[$key] ?? []),
                Arr::wrap($value)
            );
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * 路由组.
     *
     * @return $this
     */
    public function group(callable $callback): static
    {
        $this->router->group($this->attributes, $callback);

        return $this;
    }
}

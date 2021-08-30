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

class RouteRegistrar
{
    /**
     * @var \Coole\Routing\Router
     */
    protected $router;

    /**
     * 路由组属性.
     *
     * @var array
     */
    protected $attributes = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * 路由组前缀
     *
     * @return $this
     */
    public function prefix(string $prefix): self
    {
        $this->attributes['prefix'] = $prefix;

        return $this;
    }

    /**
     * 路由组中间件.
     *
     * @param $middleware
     *
     * @return $this
     */
    public function middleware($middleware): self
    {
        $this->attributes['middleware'] = (array) $middleware;

        return $this;
    }

    /**
     * 路由组.
     *
     * @return $this
     */
    public function group(callable $callback)
    {
        $this->router->group($this->attributes, $callback);

        return $this;
    }
}

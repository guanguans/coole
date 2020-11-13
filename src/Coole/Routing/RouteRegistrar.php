<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Routing;

class RouteRegistrar
{
    /**
     * @var \Guanguans\Coole\Routing\Router
     */
    protected $router;

    protected $attributes = [];

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function prefix($prefix)
    {
        $this->attributes['prefix'] = $prefix;

        return $this;
    }

    public function group(callable $callback)
    {
        $this->router->group($this->attributes, $callback);

        return $this;
    }
}

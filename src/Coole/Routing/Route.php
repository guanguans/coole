<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Routing;

class Route extends \Symfony\Component\Routing\Route
{
    protected $middleware = [];

    public function __construct(string $path = '/', array $defaults = [], array $requirements = [], array $options = [], ?string $host = '', $schemes = [], $methods = [], ?string $condition = '')
    {
        parent::__construct($path, $defaults, $requirements, $options, $host, $schemes, $methods, $condition);
    }

    public function setMiddleware($middleware)
    {
        $this->middleware = array_merge($this->middleware, (array) $middleware);

        return $this;
    }

    public function getMiddleware()
    {
        return $this->middleware;
    }
}

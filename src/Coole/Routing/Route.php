<?php

declare(strict_types=1);

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
    /**
     * 中间件.
     *
     * @var array
     */
    protected $middleware = [];

    public function __construct(string $path = '/', array $defaults = [], array $requirements = [], array $options = [], ?string $host = '', $schemes = [], $methods = [], ?string $condition = '')
    {
        parent::__construct($path, $defaults, $requirements, $options, $host, $schemes, $methods, $condition);
    }

    /**
     * 设置中间件.
     *
     * @param $middleware
     *
     * @return $this
     */
    public function setMiddleware($middleware): self
    {
        return $this->addMiddleware($middleware);
    }

    /**
     * 添加中间件.
     *
     * @param $middleware
     *
     * @return $this
     */
    public function addMiddleware($middleware): self
    {
        $this->middleware = array_unique(array_merge($this->middleware, (array) $middleware));

        return $this;
    }

    /**
     * 获取中间件.
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}

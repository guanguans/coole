<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Concerns;

trait HasMiddleware
{
    /**
     * 中间件.
     *
     * @var array<string|callable>
     */
    protected array $middleware = [];

    /**
     * 排除的中间件.
     *
     * @var array<string|callable>
     */
    protected array $withoutMiddleware = [];

    /**
     * 获取中间件.
     *
     * @return array<string|callable>
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * 设置中间件.
     *
     * @param string|callable|array<string|callable> $middleware
     *
     * @return $this
     */
    public function setMiddleware(string|callable|array $middleware): static
    {
        $this->addMiddleware($middleware);

        return $this;
    }

    /**
     * 添加中间件.
     *
     * @param string|callable|array<string|callable> $middleware
     *
     * @return $this
     */
    public function addMiddleware(string|callable|array $middleware): static
    {
        if (is_object($middleware)) {
            $middleware = [$middleware];
        }

        $this->middleware = array_merge($this->middleware, (array) $middleware);

        return $this;
    }

    /**
     * 获取排除的中间件.
     *
     * @return array<string|callable>
     */
    public function getWithoutMiddleware(): array
    {
        return $this->withoutMiddleware;
    }

    /**
     * 设置排除的中间件.
     *
     * @param string|array<string> $middleware
     *
     * @return $this
     */
    public function setWithoutMiddleware(string|array $withoutMiddleware): static
    {
        $this->addWithoutMiddleware($withoutMiddleware);

        return $this;
    }

    /**
     * 添加排除的中间件.
     *
     * @param string|array<string> $middleware
     *
     * @return $this
     */
    public function addWithoutMiddleware(string|array $withoutMiddleware): static
    {
        $this->withoutMiddleware = array_unique(
            array_merge($this->withoutMiddleware, (array) $withoutMiddleware)
        );

        return $this;
    }
}

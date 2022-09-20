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
     */
    public function setMiddleware(string|callable|array $middleware): void
    {
        $this->addMiddleware($middleware);
    }

    /**
     * 添加中间件.
     *
     * @param string|callable|array<string|callable> $middleware
     */
    public function addMiddleware(string|callable|array $middleware): void
    {
        if (is_object($middleware)) {
            $middleware = [$middleware];
        }

        $this->middleware = array_merge($this->middleware, (array) $middleware);
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
     */
    public function setWithoutMiddleware(string|array $withoutMiddleware): void
    {
        $this->addWithoutMiddleware($withoutMiddleware);
    }

    /**
     * 添加排除的中间件.
     *
     * @param string|array<string> $middleware
     */
    public function addWithoutMiddleware(string|array $withoutMiddleware): void
    {
        $this->withoutMiddleware = array_unique(
            array_merge($this->withoutMiddleware, (array) $withoutMiddleware)
        );
    }
}

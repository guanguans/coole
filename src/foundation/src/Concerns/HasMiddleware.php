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

use Coole\Foundation\Middlewares\MiddlewareInterface;

trait HasMiddleware
{
    /**
     * 中间件.
     *
     * @var array<string>
     */
    protected array $middleware = [];

    /**
     * 排除的中间件.
     *
     * @var array<string>
     */
    protected array $excludedMiddleware = [];

    /**
     * 获取中间件.
     *
     * @return array<string>
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * 设置中间件.
     *
     * @param string|array<string> $middleware
     */
    public function setMiddleware(string|array|callable|MiddlewareInterface $middleware): void
    {
        $this->addMiddleware($middleware);
    }

    /**
     * 添加中间件.
     *
     * @param string|callable|MiddlewareInterface|array<string|callable|MiddlewareInterface> $middleware
     */
    public function addMiddleware(string|array|callable|MiddlewareInterface $middleware): void
    {
        $this->middleware = array_unique(array_merge($this->middleware, (array) $middleware));
    }

    /**
     * 获取排除的中间件.
     *
     * @return string|callable|MiddlewareInterface|array<string|callable|MiddlewareInterface>
     */
    public function getExcludedMiddleware(): array
    {
        return $this->excludedMiddleware;
    }

    /**
     * 排除中间件.
     *
     * @param string|array<string> $middleware
     */
    public function withoutMiddleware(string|array $excludedMiddleware): void
    {
        $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 设置排除的中间件.
     *
     * @param string|array<string> $middleware
     */
    public function setExcludedMiddleware(string|array $excludedMiddleware): void
    {
        $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 添加排除的中间件.
     *
     * @param string|array<string> $middleware
     */
    public function addExcludedMiddleware(string|array $excludedMiddleware): void
    {
        $this->excludedMiddleware = array_unique(array_merge($this->excludedMiddleware, (array) $excludedMiddleware));
    }
}

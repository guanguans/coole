<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Concerns;

use Coole\Foundation\Middlewares\MiddlewareInterface;
use SplFileInfo;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

trait HasController
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
     * {@inheritdoc}
     */
    public function render($name, array $context = []): string
    {
        return app('view')->render($name, $context);
    }

    /**
     * 重定 url.
     */
    public function redirect(string $url, int $status = 302, array $headers = []): RedirectResponse
    {
        return new RedirectResponse($url, $status, $headers);
    }

    /**
     * 抛出 Http 异常.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function abort(int $statusCode, string $message = '', array $headers = []): void
    {
        throw new HttpException($statusCode, $message, null, $headers);
    }

    /**
     * 返回流响应.
     */
    public function stream(callable $callback = null, int $status = 200, array $headers = []): StreamedResponse
    {
        return new StreamedResponse($callback, $status, $headers);
    }

    /**
     * 返回 Json 响应.
     */
    public function json(array $data = [], int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * 返回二进制文件响应.
     */
    public function sendFile(SplFileInfo|string $file, int $status = 200, array $headers = [], string $contentDisposition = null): BinaryFileResponse
    {
        return new BinaryFileResponse($file, $status, $headers, true, $contentDisposition);
    }

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

    /**
     * 添加一个 `KernelEvents::TERMINATE` 事件监听处理器.
     *
     * 用来处理耗时逻辑业务
     */
    public function addFinishHandler(callable $listener, int $priority = 0): void
    {
        app('event_dispatcher')->addListener(KernelEvents::TERMINATE, $listener, $priority);
    }

    /**
     * 设置一个 `KernelEvents::TERMINATE` 事件监听处理器.
     *
     * 用来处理耗时逻辑业务
     */
    public function setFinishHandler(callable $listener, int $priority = 0): void
    {
        $this->addFinishHandler($listener, $priority);
    }
}

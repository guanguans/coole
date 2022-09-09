<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Controller;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

trait HasControllerAble
{
    /**
     * 中间件.
     */
    protected array $middleware = [];

    /**
     * 排除的中间件.
     */
    protected array $excludedMiddleware = [];

    /**
     * {@inheritdoc}
     */
    public function render($name, $context = []): string
    {
        return app('view')->render($name, $context);
    }

    /**
     * 重定 url.
     *
     * @param $url
     */
    public function redirect($url, int $status = 302, array $headers = []): RedirectResponse
    {
        return new RedirectResponse($url, $status, $headers);
    }

    /**
     * 抛出 http 异常.
     *
     * @param $statusCode
     */
    public function abort($statusCode, string $message = '', array $headers = [])
    {
        throw new HttpException($statusCode, $message, null, $headers);
    }

    /**
     * 返回流响应.
     *
     * @param null $callback
     */
    public function stream($callback = null, int $status = 200, array $headers = []): StreamedResponse
    {
        return new StreamedResponse($callback, $status, $headers);
    }

    /**
     * 返回 json 响应.
     *
     * @param mixed[] $data
     */
    public function json(array $data = [], int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * 返回二进制文件响应.
     *
     * @param $file
     * @param null $contentDisposition
     */
    public function sendFile($file, int $status = 200, array $headers = [], $contentDisposition = null): BinaryFileResponse
    {
        return new BinaryFileResponse($file, $status, $headers, true, $contentDisposition);
    }

    /**
     * 获取中间件.
     *
     * @return mixed[]
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * 设置中间件.
     *
     * @param $middleware
     */
    public function setMiddleware($middleware): void
    {
        $this->addMiddleware($middleware);
    }

    /**
     * 添加中间件.
     *
     * @param $middleware
     */
    public function addMiddleware($middleware): void
    {
        $this->middleware = array_unique(array_merge($this->middleware, (array) $middleware));
    }

    /**
     * 获取排除的中间件.
     *
     * @return mixed[]
     */
    public function getExcludedMiddleware(): array
    {
        return $this->excludedMiddleware;
    }

    /**
     * 排除中间件.
     *
     * @param $excludedMiddleware
     */
    public function withoutMiddleware($excludedMiddleware): void
    {
        $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 设置排除的中间件.
     *
     * @param $excludedMiddleware
     */
    public function setExcludedMiddleware($excludedMiddleware): void
    {
        $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 添加排除的中间件.
     *
     * @param $excludedMiddleware
     *
     * @return $this
     */
    public function addExcludedMiddleware($excludedMiddleware): void
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
        app('event.dispatcher')->addListener(KernelEvents::TERMINATE, $listener, $priority);
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

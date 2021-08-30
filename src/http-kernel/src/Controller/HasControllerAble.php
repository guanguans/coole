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
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * 排除的中间件.
     *
     * @var array
     */
    protected $excludedMiddleware = [];

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
     * @param int $status
     */
    public function redirect($url, $status = 302, array $headers = []): RedirectResponse
    {
        return new RedirectResponse($url, $status, $headers);
    }

    /**
     * 抛出 http 异常.
     *
     * @param $statusCode
     * @param string $message
     */
    public function abort($statusCode, $message = '', array $headers = [])
    {
        throw new HttpException($statusCode, $message, null, $headers);
    }

    /**
     * 返回流响应.
     *
     * @param null $callback
     * @param int  $status
     */
    public function stream($callback = null, $status = 200, array $headers = []): StreamedResponse
    {
        return new StreamedResponse($callback, $status, $headers);
    }

    /**
     * 返回 json 响应.
     *
     * @param array $data
     * @param int   $status
     */
    public function json($data = [], $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }

    /**
     * 返回二进制文件响应.
     *
     * @param $file
     * @param int  $status
     * @param null $contentDisposition
     */
    public function sendFile($file, $status = 200, array $headers = [], $contentDisposition = null): BinaryFileResponse
    {
        return new BinaryFileResponse($file, $status, $headers, true, $contentDisposition);
    }

    /**
     * 获取中间件.
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
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
     * 获取排除的中间件.
     */
    public function getExcludedMiddleware(): array
    {
        return $this->excludedMiddleware;
    }

    /**
     * 排除中间件.
     *
     * @param $excludedMiddleware
     *
     * @return $this
     */
    public function withoutMiddleware($excludedMiddleware): self
    {
        return $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 设置排除的中间件.
     *
     * @param $excludedMiddleware
     *
     * @return $this
     */
    public function setExcludedMiddleware($excludedMiddleware): self
    {
        return $this->addExcludedMiddleware($excludedMiddleware);
    }

    /**
     * 添加排除的中间件.
     *
     * @param $excludedMiddleware
     *
     * @return $this
     */
    public function addExcludedMiddleware($excludedMiddleware): self
    {
        $this->excludedMiddleware = array_unique(array_merge($this->excludedMiddleware, (array) $excludedMiddleware));

        return $this;
    }

    /**
     * 添加一个 `KernelEvents::TERMINATE` 事件监听处理器.
     *
     * 用来处理耗时逻辑业务
     *
     * @param callable $listener
     */
    public function addFinishHandler($listener, int $priority = 0)
    {
        app('event_dispatcher')->addListener(KernelEvents::TERMINATE, $listener, $priority);

        return $this;
    }

    /**
     * 设置一个 `KernelEvents::TERMINATE` 事件监听处理器.
     *
     * 用来处理耗时逻辑业务
     *
     * @param callable $listener
     */
    public function setFinishHandler($listener, int $priority = 0)
    {
        return $this->addFinishHandler($listener, $priority);
    }
}

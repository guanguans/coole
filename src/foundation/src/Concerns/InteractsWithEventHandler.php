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

use Coole\EventDispatcher\EventDispatcher;
use Coole\Foundation\Events\ExceptionEvent;
use Coole\Foundation\Events\RequestHandledEvent;
use Coole\Foundation\Events\TerminateEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;

trait InteractsWithEventHandler
{
    /**
     * 添加一个 `KernelEvents::REQUEST` 事件监听处理器.
     */
    public function addKernelRequestHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::REQUEST, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::EXCEPTION` 事件监听处理器.
     */
    public function addKernelExceptionHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::EXCEPTION, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::CONTROLLER` 事件监听处理器.
     */
    public function addKernelControllerHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::CONTROLLER, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::CONTROLLER_ARGUMENTS` 事件监听处理器.
     */
    public function addKernelControllerArgumentsHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::CONTROLLER_ARGUMENTS, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::VIEW` 事件监听处理器.
     */
    public function addKernelViewHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::VIEW, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::RESPONSE` 事件监听处理器.
     */
    public function addKernelResponseHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::RESPONSE, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::FINISH_REQUEST` 事件监听处理器.
     */
    public function addKernelFinishRequestHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::FINISH_REQUEST, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::TERMINATE` 事件监听处理器.
     */
    public function addKernelTerminateHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::TERMINATE, $listener, $priority);
    }

    /**
     * 添加一个 `ExceptionEvent::class` 事件监听处理器.
     */
    public function addExceptionHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(ExceptionEvent::class, $listener, $priority);
    }

    /**
     * 添加一个 `RequestHandledEvent::class` 事件监听处理器.
     */
    public function addRequestHandledHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(RequestHandledEvent::class, $listener, $priority);
    }

    /**
     * 添加一个 `TerminateEvent::class` 事件监听处理器.
     */
    public function addTerminateHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(TerminateEvent::class, $listener, $priority);
    }

    /**
     * 获取事件派遣器.
     */
    protected function getDispatcher(): EventDispatcher
    {
        return app(EventDispatcherInterface::class);
    }
}

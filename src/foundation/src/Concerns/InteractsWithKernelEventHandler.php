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
use Symfony\Component\HttpKernel\KernelEvents;

trait InteractsWithKernelEventHandler
{
    /**
     * 添加一个 `KernelEvents::REQUEST` 事件监听处理器.
     */
    public function addRequestHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::REQUEST, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::EXCEPTION` 事件监听处理器.
     */
    public function addExceptionHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::EXCEPTION, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::CONTROLLER` 事件监听处理器.
     */
    public function addControllerHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::CONTROLLER, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::CONTROLLER_ARGUMENTS` 事件监听处理器.
     */
    public function addControllerArgumentsHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::CONTROLLER_ARGUMENTS, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::VIEW` 事件监听处理器.
     */
    public function addViewHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::VIEW, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::RESPONSE` 事件监听处理器.
     */
    public function addResponseHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::RESPONSE, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::FINISH_REQUEST` 事件监听处理器.
     */
    public function addFinishRequestHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::FINISH_REQUEST, $listener, $priority);
    }

    /**
     * 添加一个 `KernelEvents::TERMINATE` 事件监听处理器.
     */
    public function addTerminateHandler(callable $listener, int $priority = 0): void
    {
        $this->getDispatcher()->addListener(KernelEvents::TERMINATE, $listener, $priority);
    }

    /**
     * 获取事件派遣器.
     */
    protected function getDispatcher(): EventDispatcher
    {
        return app('event_dispatcher');
    }
}

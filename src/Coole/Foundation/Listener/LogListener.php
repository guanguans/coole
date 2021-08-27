<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Foundation\Listener;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class LogListener implements EventSubscriberInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Closure
     */
    protected $exceptionLogFilter;

    public function __construct(LoggerInterface $logger, $exceptionLogFilter = null)
    {
        $this->logger = $logger;
        if (null === $exceptionLogFilter) {
            $exceptionLogFilter = function (\Exception $e) {
                if ($e instanceof HttpExceptionInterface && $e->getStatusCode() < 500) {
                    return LogLevel::ERROR;
                }

                return LogLevel::CRITICAL;
            };
        }

        $this->exceptionLogFilter = $exceptionLogFilter;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if (! $event->isMasterRequest()) {
            return;
        }

        $this->logger->log(LogLevel::DEBUG, '> '.$event->getRequest()->getMethod().' '.$event->getRequest()->getRequestUri());
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        if (! $event->isMasterRequest()) {
            return;
        }

        $message = '< '.$event->getResponse()->getStatusCode();

        if ($event->getResponse() instanceof RedirectResponse) {
            $message .= ' '.$event->getResponse()->getTargetUrl();
        }

        $this->logger->log(LogLevel::DEBUG, $message);
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $this->logger->log(call_user_func($this->exceptionLogFilter, $event->getThrowable()), sprintf('%s: %s (uncaught exception) at %s line %s', get_class($event->getThrowable()), $event->getThrowable()->getMessage(), $event->getThrowable()->getFile(), $event->getThrowable()->getLine()), ['exception' => $event->getThrowable()]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 0],
            KernelEvents::RESPONSE => ['onKernelResponse', 0],
            KernelEvents::EXCEPTION => ['onKernelException', -4],
        ];
    }
}

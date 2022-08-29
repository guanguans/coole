<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Listeners;

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
        if (! $event->isMainRequest()) {
            return;
        }

        $this->logger->log(LogLevel::DEBUG, '> '.$event->getRequest()->getMethod().' '.$event->getRequest()->getRequestUri());
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        if (! $event->isMainRequest()) {
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

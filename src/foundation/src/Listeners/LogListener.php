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
use Throwable;

class LogListener implements EventSubscriberInterface
{
    /**
     * @var callable|\Closure|null
     */
    protected $exceptionLogFilter;

    public function __construct(protected LoggerInterface $logger, ?callable $exceptionLogFilter = null)
    {
        if (null === $exceptionLogFilter) {
            $exceptionLogFilter = static function (Throwable $throwable) {
                if ($throwable instanceof HttpExceptionInterface && $throwable->getStatusCode() < 500) {
                    return LogLevel::ERROR;
                }

                return LogLevel::CRITICAL;
            };
        }

        $this->exceptionLogFilter = $exceptionLogFilter;
    }

    public function onKernelRequest(RequestEvent $requestEvent): void
    {
        if (! $requestEvent->isMainRequest()) {
            return;
        }

        $this->logger->log(
            LogLevel::DEBUG,
            '> '.$requestEvent->getRequest()->getMethod().' '.$requestEvent->getRequest()->getRequestUri()
        );
    }

    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        if (! $responseEvent->isMainRequest()) {
            return;
        }

        $message = '< '.$responseEvent->getResponse()->getStatusCode();

        if ($responseEvent->getResponse() instanceof RedirectResponse) {
            $message .= ' '.$responseEvent->getResponse()->getTargetUrl();
        }

        $this->logger->log(LogLevel::DEBUG, $message);
    }

    public function onKernelException(ExceptionEvent $exceptionEvent): void
    {
        $this->logger->log(
            call_user_func($this->exceptionLogFilter, $exceptionEvent->getThrowable()),
            sprintf(
                '%s: %s (uncaught exception) at %s line %s',
                $exceptionEvent->getThrowable()::class,
                $exceptionEvent->getThrowable()->getMessage(),
                $exceptionEvent->getThrowable()->getFile(),
                $exceptionEvent->getThrowable()->getLine()
            ),
            ['exception' => $exceptionEvent->getThrowable()]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 0],
            KernelEvents::RESPONSE => ['onKernelResponse', 0],
            KernelEvents::EXCEPTION => ['onKernelException', -4],
        ];
    }
}

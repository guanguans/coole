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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Throwable;

/**
 * Logs request, response, and exceptions.
 *
 * This is modified from https://github.com/silexphp/Silex.
 */
class LogListener implements EventSubscriberInterface
{
    /**
     * @var callable|null
     */
    protected $exceptionLogFilter;

    public function __construct(protected LoggerInterface $logger, callable $exceptionLogFilter = null)
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

    /**
     * Logs master requests on event KernelEvents::REQUEST.
     */
    public function onKernelRequest(RequestEvent $requestEvent): void
    {
        if (! $requestEvent->isMainRequest()) {
            return;
        }

        $this->logRequest($requestEvent->getRequest());
    }

    /**
     * Logs master response on event KernelEvents::RESPONSE.
     */
    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        if (! $responseEvent->isMainRequest()) {
            return;
        }

        $this->logResponse($responseEvent->getResponse());
    }

    /**
     * Logs uncaught exceptions on event KernelEvents::EXCEPTION.
     */
    public function onKernelException(ExceptionEvent $exceptionEvent): void
    {
        $this->logException($exceptionEvent->getThrowable());
    }

    /**
     * Logs a request.
     */
    protected function logRequest(Request $request): void
    {
        $this->logger->log(LogLevel::DEBUG, '> '.$request->getMethod().' '.$request->getRequestUri());
    }

    /**
     * Logs a response.
     */
    protected function logResponse(Response $response): void
    {
        $message = '< '.$response->getStatusCode();

        if ($response instanceof RedirectResponse) {
            $message .= ' '.$response->getTargetUrl();
        }

        $this->logger->log(LogLevel::DEBUG, $message);
    }

    /**
     * Logs an exception.
     */
    protected function logException(Throwable $throwable): void
    {
        $this->logger->log(
            call_user_func($this->exceptionLogFilter, $throwable),
            sprintf('%s: %s (uncaught exception) at %s line %s', $throwable::class, $throwable->getMessage(), $throwable->getFile(), $throwable->getLine()),
            ['exception' => $throwable]
        );
    }

    /**
     * @return array[]
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

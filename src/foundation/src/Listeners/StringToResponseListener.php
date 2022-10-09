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

use Stringable;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Converts string responses to proper Response instances.
 *
 * This is modified from https://github.com/silexphp/Silex.
 */
class StringToResponseListener implements EventSubscriberInterface
{
    /**
     * Handles string responses.
     */
    public function onKernelView(ViewEvent $viewEvent): void
    {
        $response = $viewEvent->getControllerResult();

        if (! (
            is_array($response)
            || $response instanceof Response
            || (is_object($response) && ! $response instanceof Stringable)
        )) {
            $viewEvent->setResponse(new Response((string) $response));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['onKernelView', -10],
        ];
    }
}

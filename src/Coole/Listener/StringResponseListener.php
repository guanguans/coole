<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StringResponseListener implements EventSubscriberInterface
{
    public function onKernelView(ViewEvent $event)
    {
        $response = $event->getControllerResult();

        if (! (
            null === $response
            || is_array($response)
            || $response instanceof Response
            || (is_object($response) && ! method_exists($response, '__toString'))
        )) {
            $event->setResponse(new Response((string) $response));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['onKernelView', -10],
        ];
    }
}

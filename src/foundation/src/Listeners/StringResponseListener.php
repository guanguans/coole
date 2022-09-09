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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StringResponseListener implements EventSubscriberInterface
{
    public function onKernelView(ViewEvent $viewEvent)
    {
        $response = $viewEvent->getControllerResult();

        if (! (
            null === $response
            || is_array($response)
            || $response instanceof Response
            || (is_object($response) && ! method_exists($response, '__toString'))
        )) {
            $viewEvent->setResponse(new Response((string) $response));
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

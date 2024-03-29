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
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 * Handles converters.
 *
 * This is modified from https://github.com/silexphp/Silex.
 */
class ConverterListener implements EventSubscriberInterface
{
    /**
     * Constructor.
     *
     * @param RouteCollection $routeCollection A RouteCollection instance
     */
    public function __construct(protected RouteCollection $routeCollection)
    {
    }

    /**
     * Handles converters.
     *
     * @param ControllerEvent $controllerEvent The event to handle
     */
    public function onKernelController(ControllerEvent $controllerEvent): void
    {
        $request = $controllerEvent->getRequest();
        $route = $this->routeCollection->get($request->attributes->get('_route'));
        if ($route && $converters = $route->getOption('_converters')) {
            foreach ($converters as $name => $callback) {
                $request->attributes->set(
                    $name,
                    call($callback, [
                        'attribute' => $request->attributes->get($name),
                        'request' => $request,
                    ]),
                );
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}

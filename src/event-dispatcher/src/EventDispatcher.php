<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventDispatcher extends SymfonyEventDispatcher
{
    /**
     * {@inheritdoc}
     */
    public function dispatch(object $event, string $eventName = null): object
    {
        $listeners = array_unique(app('event_dispatcher.listener_collection')->get($event::class, []));

        foreach ($listeners as $listener) {
            if (is_callable($listener)) {
                $this->addListener($event::class, $listener);
                continue;
            }

            is_string($listener) and $listener = app($listener);
            $listener instanceof ListenerInterface and $this->addListener($event::class, [$listener, 'handle']);
            $listener instanceof EventSubscriberInterface and $this->addSubscriber($listener);
        }

        return parent::dispatch($event, $eventName);
    }
}

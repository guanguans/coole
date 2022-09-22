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

use Illuminate\Container\Container;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventDispatcher extends SymfonyEventDispatcher
{
    public function __construct(protected Container $container)
    {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(object $event, string $eventName = null): object
    {
        $listeners = app(ListenerCollection::class)->get($event::class, []);

        foreach ($listeners as $listener) {
            if (is_callable($listener)) {
                $this->addListener($event::class, $listener);

                continue;
            }

            if (is_string($listener)) {
                $listener = $this->container->make($listener);
            }

            if (is_callable($listener)) {
                $this->addListener($event::class, $listener);

                continue;
            }

            if ($listener instanceof EventSubscriberInterface) {
                $this->addSubscriber($listener);

                continue;
            }

            if ($listener instanceof ListenerInterface) {
                $this->addListener($event::class, [$listener, 'handle']);

                continue;
            }

            throw new RuntimeException(sprintf('The %s is not a callback type.', $event::class));
        }

        return parent::dispatch($event, $eventName);
    }
}

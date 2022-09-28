<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static void                       addListener(string $eventName, callable|array $listener, int $priority = 0)
 * @method static void                       addSubscriber(\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
 * @method static object                     dispatch(object $event, string $eventName = null)
 * @method static int|null                   getListenerPriority(string $eventName, callable|array $listener)
 * @method static array<callable[]|callable> getListeners(string $eventName = null)
 * @method static bool                       hasListeners(string $eventName = null)
 * @method static void                       removeListener(string $eventName, callable|array $listener)
 * @method static void                       removeSubscriber(\Symfony\Component\EventDispatcher\EventSubscriberInterface $subscriber)
 *
 * @mixin  \Coole\EventDispatcher\EventDispatcher
 *
 * @see \Coole\EventDispatcher\EventDispatcher
 */
class EventDispatcher extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'event-dispatcher';
    }
}

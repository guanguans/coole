<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Event;

use Coole\Foundation\ServiceProvider;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(EventDispatcher::class);
        $this->app->alias(EventDispatcher::class, 'event.dispatcher');

        $this->app->singleton(ListenerCollection::class);
        $this->app->alias(ListenerCollection::class, 'event.listener.collection');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        $this->app['event.listener.collection'] = $this->app['event.listener.collection']->merge($this->app['config']['event']['event.listener.collection'] ?? []);
    }
}

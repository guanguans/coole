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
use Illuminate\Support\Collection as Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(EventDispatcher::class, function ($app) {
            return new EventDispatcher();
        });
        $this->app->alias(EventDispatcher::class, 'event_dispatcher');

        $this->app->singleton('listener', function () {
            return new Listener();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        $this->app['listener'] = $this->app['listener']->merge($this->app['config']['event']['listener'] ?? []);
    }
}

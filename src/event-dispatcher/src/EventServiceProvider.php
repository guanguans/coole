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

use Coole\Foundation\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        EventDispatcher::class,
        ListenerCollection::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        EventDispatcher::class => ['event_dispatcher'],
        ListenerCollection::class => ['event_dispatcher.listener_collection'],
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/event.php');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->app['event_dispatcher.listener_collection']->merge($this->app['config']->get('event.listen', []));
    }
}

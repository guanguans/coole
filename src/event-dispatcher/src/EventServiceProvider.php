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
use Psr\EventDispatcher\EventDispatcherInterface as PsrEventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface as SymfonyEventDispatcherInterface;

class EventServiceProvider extends ServiceProvider
{
    protected array $bindings = [
        PsrEventDispatcherInterface::class => EventDispatcher::class,
        SymfonyEventDispatcherInterface::class => EventDispatcher::class,
    ];

    protected array $singletons = [
        EventDispatcher::class,
        ListenCollection::class,
    ];

    protected array $aliases = [
        EventDispatcher::class => ['event-dispatcher'],
        ListenCollection::class => ['event-dispatcher.listen-collection'],
    ];

    protected array $classAliases = [
        \Coole\EventDispatcher\Facades\EventDispatcher::class,
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/event.php');
    }

    public function boot(): void
    {
        $this->app[ListenCollection::class] = $this->app[ListenCollection::class]->mergeRecursive($this->app['config']->get('event.listen', []));
    }
}

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

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Guanguans\Di\Container;
use Illuminate\Support\Collection as Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(EventDispatcher::class, function ($app) {
            return new EventDispatcher();
        });
        $app->alias(EventDispatcher::class, 'event_dispatcher');

        $app->singleton('listener', function () {
            return new Listener();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        $app['listener'] = $app['listener']->merge($app['config']['event']['listener'] ?? []);
    }
}

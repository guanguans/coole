<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Database;

use Coole\Foundation\ServiceProvider;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering()
    {
        $this->app->loadConfig(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(Manager::class, function ($app) {
            return new Manager();
        });

        $this->app->alias(Manager::class, 'database');
        $this->app->alias(Manager::class, 'database');
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->app['database']->addConnection($this->app['config']['database']['connections'][$this->app['config']['database']['default']]);
        // Set the event dispatcher used by Eloquent models... (optional)
        $this->app['database']->setEventDispatcher(new Dispatcher(new IlluminateContainer()));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->app['database']->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->app['database']->bootEloquent();
    }
}
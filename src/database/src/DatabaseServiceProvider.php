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

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Illuminate\Container\Container;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->loadConfig(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Manager::class, function ($app) {
            return new Manager();
        });

        $app->alias(Manager::class, 'database');
        $app->alias(Manager::class, 'database');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(App $app)
    {
        $app['database']->addConnection($app['config']['database']['connections'][$app['config']['database']['default']]);
        // Set the event dispatcher used by Eloquent models... (optional)
        $app['database']->setEventDispatcher(new Dispatcher(new IlluminateContainer()));

        // Make this Capsule instance available globally via static methods... (optional)
        $app['database']->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $app['database']->bootEloquent();
    }
}

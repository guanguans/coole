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

use Coole\Database\Facades\DB;
use Coole\Foundation\ServiceProvider;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DatabaseServiceProvider extends ServiceProvider
{
    protected array $aliases = [
        Manager::class => ['db', 'database.manager'],
    ];

    protected array $classAliases = [
        DB::class,
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/database.php');
    }

    public function register(): void
    {
        $this->app->singleton(Manager::class, static fn (): Manager => new Manager());
    }

    public function boot(): void
    {
        $this->app['db']->addConnection(
            $this->app['config']['database.connections'][$this->app['config']['database.default']]
        );
        // Set the event dispatcher used by Eloquent models... (optional)
        $this->app['db']->setEventDispatcher($this->app->make(Dispatcher::class));
        // Make this Capsule instance available globally via static methods... (optional)
        $this->app['db']->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->app['db']->bootEloquent();
    }
}

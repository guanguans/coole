<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\DB;

use Coole\Foundation\Able\BeforeRegisterAbleProviderInterface;
use Coole\Foundation\Able\BootAbleProviderInterface;
use Coole\Foundation\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DBServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface, BootAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'database' => [
                'default' => 'mysql',
                'connections' => [
                    'mysql' => [
                        'driver' => 'mysql',
                        'url' => '',
                        'host' => '127.0.0.1',
                        'port' => '3306',
                        'database' => 'coole',
                        'username' => 'coole',
                        'password' => '',
                        'unix_socket' => '',
                        'charset' => 'utf8mb4',
                        'collation' => 'utf8mb4_unicode_ci',
                        'prefix' => '',
                        'prefix_indexes' => true,
                        'strict' => true,
                        'engine' => null,
                        'options' => [],
                    ],
                ],
            ],
        ]);
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
        $app->alias(Manager::class, 'db');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(App $app)
    {
        $app['db']->addConnection($app['config']['database']['connections'][$app['config']['database']['default']]);
        // Set the event dispatcher used by Eloquent models... (optional)
        $app['db']->setEventDispatcher(new Dispatcher(new IlluminateContainer()));

        // Make this Capsule instance available globally via static methods... (optional)
        $app['db']->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $app['db']->bootEloquent();
    }
}

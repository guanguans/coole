<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

/**
 * $app = new App();
 * $app->offsetSet('dbs.options', [
 *     'db' => [
 *         'driver'   => 'pdo_mysql',
 *         'host'     => '192.168.10.10',
 *         'dbname'   => 'homestead',
 *         'user'     => 'homestead',
 *         'password' => 'secret',
 *         'charset'  => 'utf8mb4',
 *     ],
 * ]);
 * $app->register(new DoctrineServiceProvider());
 * $sql  = "SELECT * FROM users WHERE id = ?";
 * $db   = app('dbs')->db;
 * $user = $db->fetchAssoc($sql, [1]);
 * dd($user);
 */
class DoctrineServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['db.default_options'] = [
            'driver' => 'pdo_mysql',
            'dbname' => null,
            'host' => 'localhost',
            'user' => 'root',
            'password' => null,
        ];

        $app['dbs.options.initializer'] = $initializer = function ($app) {
            static $initialized = false;

            if ($initialized) {
                return;
            }

            $initialized = true;

            if (! isset($app['dbs.options'])) {
                $app['dbs.options'] = ['default' => isset($app['db.options']) ? $app['db.options'] : []];
            }

            $tmp = $app['dbs.options'];
            foreach ($tmp as $name => &$options) {
                $options = array_replace($app['db.default_options'], $options);

                if (! isset($app['dbs.default'])) {
                    $app['dbs.default'] = $name;
                }
            }
            $app['dbs.options'] = $tmp;
        };

        $app->singleton('dbs', function ($app) use ($initializer) {
            $initializer($app);

            $dbs = new Container();
            foreach ($app['dbs.options'] as $name => $options) {
                if ($app['dbs.default'] === $name) {
                    // we use shortcuts here in case the default has been overridden
                    $config = $app['db.config'];
                    $manager = $app['db.event_manager'];
                } else {
                    $config = $app['dbs.config'][$name];
                    $manager = $app['dbs.event_manager'][$name];
                }

                $dbs[$name] = function ($dbs) use ($options, $config, $manager) {
                    return DriverManager::getConnection($options, $config, $manager);
                };
            }

            return $dbs;
        });

        $app->singleton('dbs.config', function ($app) use ($initializer) {
            $initializer($app);

            $configs = new Container();
            foreach ($app['dbs.options'] as $name => $options) {
                $configs[$name] = new Configuration();
            }

            return $configs;
        });

        $app->singleton('dbs.event_manager', function ($app) use ($initializer) {
            $initializer($app);

            $managers = new Container();
            foreach ($app['dbs.options'] as $name => $options) {
                $managers[$name] = new EventManager();
            }

            return $managers;
        });

        $app->singleton('db', function ($app) {
            $dbs = $app['dbs'];

            return $dbs[$app['dbs.default']];
        });

        $app->singleton('db.config', function ($app) {
            $dbs = $app['dbs.config'];

            return $dbs[$app['dbs.default']];
        });

        $app->singleton('db.event_manager', function ($app) {
            $dbs = $app['dbs.event_manager'];

            return $dbs[$app['dbs.default']];
        });
    }
}

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
 *     'db_mysql' => [
 *         'driver'   => 'pdo_mysql',
 *         'host'     => '192.168.10.10',
 *         'dbname'   => 'homestead',
 *         'user'     => 'homestead',
 *         'password' => 'secret',
 *         'charset'  => 'utf8mb4',
 *     ],
 *     'db_sqlite' => [
 *         'driver'   => 'pdo_sqlite',
 *         'path'   => __DIR__.'/app.db',
 *     ],
 * ]);
 * $app->register(new DoctrineServiceProvider());
 * $dbMysql  = app('dbs')->db_mysql;
 * $user     = $dbMysql->fetchAssoc('SELECT * FROM users WHERE id = ?', [1]);
 * $dbSqlite = app('dbs')->db_sqlite;
 */
class DoctrineServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $this->defaultOptions($app);

        $app->singleton('dbs', function ($app) {
            $this->optionsInitializer($app);

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

        $app->singleton('dbs.config', function ($app) {
            $this->optionsInitializer($app);

            $configs = new Container();
            foreach ($app['dbs.options'] as $name => $options) {
                $configs[$name] = new Configuration();
            }

            return $configs;
        });

        $app->singleton('dbs.event_manager', function ($app) {
            $this->optionsInitializer($app);

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

    protected function defaultOptions(Container $app)
    {
        $app['db.default_options'] = [
            'driver' => 'pdo_mysql',
            'dbname' => null,
            'host' => 'localhost',
            'user' => 'root',
            'password' => null,
        ];
    }

    protected function optionsInitializer(Container $app)
    {
        static $initialized = false;

        if ($initialized) {
            return;
        }

        $initialized = true;

        if (! isset($app['dbs.options'])) {
            $app['dbs.options'] = ['default' => isset($app['db.options']) ? $app['db.options'] : []];
        }

        $tmp = $app['dbs.options'];
        array_walk($tmp, function (&$options, $name) use ($app) {
            $options = array_replace($app['db.default_options'], $options);

            if (! isset($app['dbs.default'])) {
                $app['dbs.default'] = $name;
            }
        });

        $app['dbs.options'] = $tmp;
    }
}

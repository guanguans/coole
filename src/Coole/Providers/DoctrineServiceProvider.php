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
 * $app['config']['dbs.options'] = [
 *      'db_mysql'  => [
 *          'driver'   => 'pdo_mysql',
 *          'host'     => '192.168.10.10',
 *          'dbname'   => 'homestead',
 *          'user'     => 'homestead',
 *          'password' => 'secret',
 *          'charset'  => 'utf8mb4',
 *      ],
 *      'db_sqlite' => [
 *          'driver' => 'pdo_sqlite',
 *          'path'   => __DIR__.'/app.db',
 *      ],
 * ];
 * $app->register(new DoctrineServiceProvider());
 * $dbMysql  = app('dbs')->db_mysql;
 * $user     = $dbMysql->fetchAssoc('SELECT * FROM users WHERE id = ?', [1]);
 * $dbSqlite = app('dbs')->db_sqlite;.
 */
class DoctrineServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $this->defaultOptions($app);

        $app->singleton('dbs', function ($app) {
            $this->optionsInitializer($app);

            $dbs = new Container();
            foreach ($app['config']['dbs.options'] as $name => $options) {
                if ($app['config']['dbs.default'] === $name) {
                    // we use shortcuts here in case the default has been overridden
                    $config = $app['config']['db.config'];
                    $manager = $app['config']['db.event_manager'];
                }
                // else {
                //     $config  = $app['config']['dbs.config'][$name];
                //     $manager = $app['config']['dbs.event_manager'][$name];
                // }

                $dbs[$name] = function ($dbs) use ($options, $config, $manager) {
                    return DriverManager::getConnection($options, $config, $manager);
                };
            }

            return $dbs;
        });

        $app->singleton('dbs.config', function ($app) {
            $this->optionsInitializer($app);

            $configs = new Container();
            foreach ($app['config']['dbs.options'] as $name => $options) {
                $configs[$name] = new Configuration();
            }

            return $configs;
        });

        $app->singleton('dbs.event_manager', function ($app) {
            $this->optionsInitializer($app);

            $managers = new Container();
            foreach ($app['config']['dbs.options'] as $name => $options) {
                $managers[$name] = new EventManager();
            }

            return $managers;
        });

        $app->singleton('db', function ($app) {
            $dbs = $app['config']['dbs'];

            return $dbs[$app['config']['dbs.default']];
        });

        $app->singleton('db.config', function ($app) {
            $dbs = $app['config']['dbs.config'];

            return $dbs[$app['config']['dbs.default']];
        });

        $app->singleton('db.event_manager', function ($app) {
            $dbs = $app['config']['dbs.event_manager'];

            return $dbs[$app['config']['dbs.default']];
        });
    }

    protected function defaultOptions(Container $app)
    {
        $app['config']['db.default_options'] = [
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

        if (! isset($app['config']['dbs.options'])) {
            $app['config']['dbs.options'] = ['default' => isset($app['config']['db.options']) ? $app['config']['db.options'] : []];
        }

        $tmp = $app['config']['dbs.options'];
        array_walk($tmp, function (&$options, $name) use ($app) {
            $options = array_replace($app['config']['db.default_options'], $options);

            if (! isset($app['config']['dbs.default'])) {
                $app['config']['dbs.default'] = $name;
            }
        });

        $app['config']['dbs.options'] = $tmp;
    }
}

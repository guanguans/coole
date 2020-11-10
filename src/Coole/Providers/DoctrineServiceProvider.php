<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Doctrine\DBAL\DriverManager;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

/**
 * ``` php
 * $app = new App();
 * $app['config']['dbs'] = [
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
 * $queryBuilder = $dbMysql->createQueryBuilder();
 * $query = $queryBuilder
 *      ->select('id', 'name')
 *      ->from('users')
 *      ->where('id = 1')
 * ;
 * $user = $dbMysql->fetchAssoc($query->getSql());
 * $dbSqlite = app('dbs')->db_sqlite;
 * ```.
 */
class DoctrineServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface
{
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'dbs' => [
                'default' => [
                    'driver' => 'pdo_mysql',
                    'dbname' => null,
                    'host' => 'localhost',
                    'user' => 'root',
                    'password' => null,
                ],
            ],
        ]);
    }

    public function register(Container $app)
    {
        $app->singleton('dbs', function ($app) {
            $dbs = Container::getInstance();
            foreach ($app['config']['dbs'] as $name => $options) {
                $dbs->singleton($name, function ($dbs) use ($options) {
                    return DriverManager::getConnection($options);
                });
            }

            return $dbs;
        });
    }
}

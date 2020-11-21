<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Database;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use think\DbManager;

class DatabaseServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface, AfterRegisterAbleProviderInterface
{
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'database' => [
                'default' => 'mysql',
                'connections' => [
                    'mysql' => [
                        'type' => 'mysql',
                        'hostname' => '127.0.0.1',
                        'hostport' => 3306,
                        'username' => 'root',
                        'password' => '',
                        'database' => '',
                        'params' => [],
                        'charset' => 'utf8',
                        'prefix' => '',
                        'debug' => true,
                    ],
                ],
            ],
        ]);
    }

    public function register(Container $app)
    {
        $app->singleton(DbManager::class, function ($app) {
            $dbManager = new DbManager();

            $dbManager->setConfig($app['config']['database']);

            return $dbManager;
        });

        $app->alias(DbManager::class, 'database');
        $app->alias(DbManager::class, 'db');
    }

    public function afterRegister(App $app)
    {
        Model::setDb($app['db']);
    }
}

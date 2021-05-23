# 数据库

> 数据库由 [illuminate/database](https://github.com/illuminate/database) 提供支持。

## 配置文件

默认 `config/database.php`。

``` php
<?php

declare(strict_types=1);

/*
 * This file is part of the coolephp/skeleton.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    /*
     * 默认数据库连接名称
     */
    'default' => cenv('DB_CONNECTION', 'mysql'),

    /*
     * 数据库连接
    */
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => cenv('DATABASE_URL'),
            'database' => cenv('DB_DATABASE', base_path('database/database.sqlite')),
            'prefix' => cenv('DATABASE_URL', ''),
            'foreign_key_constraints' => cenv('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => cenv('DATABASE_URL'),
            'host' => cenv('DB_HOST', '127.0.0.1'),
            'port' => cenv('DB_PORT', '3306'),
            'database' => cenv('DB_DATABASE', 'forge'),
            'username' => cenv('DB_USERNAME', 'forge'),
            'password' => cenv('DB_PASSWORD', ''),
            'unix_socket' => cenv('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => cenv('DATABASE_URL', ''),
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => cenv('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => cenv('DATABASE_URL'),
            'host' => cenv('DB_HOST', '127.0.0.1'),
            'port' => cenv('DB_PORT', '5432'),
            'database' => cenv('DB_DATABASE', 'forge'),
            'username' => cenv('DB_USERNAME', 'forge'),
            'password' => cenv('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => cenv('DATABASE_URL', ''),
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => cenv('DATABASE_URL'),
            'host' => cenv('DB_HOST', 'localhost'),
            'port' => cenv('DB_PORT', '1433'),
            'database' => cenv('DB_DATABASE', 'forge'),
            'username' => cenv('DB_USERNAME', 'forge'),
            'password' => cenv('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => cenv('DATABASE_URL', ''),
            'prefix_indexes' => true,
        ],
    ],

    /*
     * 迁移存储库表
     */
    'migrations' => 'migrations',
];
```

## 使用方法请参考 [illuminate/database](https://learnku.com/docs/laravel/7.x/database/7493)

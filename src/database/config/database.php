<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

return [
    /**
     * 默认数据库连接名称.
     */
    'default' => cenv('DB_CONNECTION', 'mysql'),

    /**
     * 数据库连接.
     */
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => cenv('DATABASE_URL'),
            'database' => cenv('DB_DATABASE', base_path('database/database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => cenv('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => cenv('DATABASE_URL'),
            'host' => cenv('DB_HOST', '127.0.0.1'),
            'port' => cenv('DB_PORT', '3306'),
            'database' => cenv('DB_DATABASE', 'coole'),
            'username' => cenv('DB_USERNAME', 'coole'),
            'password' => cenv('DB_PASSWORD', ''),
            'unix_socket' => cenv('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
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
            'database' => cenv('DB_DATABASE', 'coole'),
            'username' => cenv('DB_USERNAME', 'coole'),
            'password' => cenv('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => cenv('DATABASE_URL'),
            'host' => cenv('DB_HOST', 'localhost'),
            'port' => cenv('DB_PORT', '1433'),
            'database' => cenv('DB_DATABASE', 'coole'),
            'username' => cenv('DB_USERNAME', 'coole'),
            'password' => cenv('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => cenv('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => cenv('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],
    ],

    /**
     * 迁移仓库表.
     */
    'migrations' => 'migrations',
];

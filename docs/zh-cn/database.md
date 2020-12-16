# 数据库

> 数据库由 [topthink/think-orm](https://github.com/top-think/think-orm) 提供支持。

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
    'default' => env('DB_DEFAULT', 'mysql'),
    'connections' => [
        'mysql' => [
            'type' => 'mysql',
            'hostname' => env('DB_HOSTNAME', '127.0.0.1'),
            'hostport' => env('DB_HOSTPORT', 3306),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'database' => env('DB_DATABASE', 'coole'),
            'params' => [],
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => env('DB_PREFIX', ''),
            'debug' => env('DB_DEBUG', false),
        ],
    ],
];
```

## 使用方法请参考 [think-orm](https://www.kancloud.cn/manual/think-orm/1258001)

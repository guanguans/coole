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
    /*
     * 默认链接
     */
    'default' => env('DB_DEFAULT', 'mysql'),

    /*
     * 链接信息
     */
    'connections' => [
        'mysql' => [
            // 类型
            'type' => 'mysql',

            // 地址
            'hostname' => env('DB_HOSTNAME', '127.0.0.1'),

            // 端口
            'hostport' => env('DB_HOSTPORT', 3306),

            // 用户名
            'username' => env('DB_USERNAME', 'root'),

            // 密码
            'password' => env('DB_PASSWORD', ''),

            // 数据库
            'database' => env('DB_DATABASE', 'coole'),

            // 额外参数
            'params' => [],

            // 字符集
            'charset' => env('DB_CHARSET', 'utf8'),

            // 表前缀
            'prefix' => env('DB_PREFIX', ''),

            // Debug
            'debug' => env('DB_DEBUG', false),
        ],
    ],
];
```

## 使用方法请参考 [think-orm](https://www.kancloud.cn/manual/think-orm/1258001)

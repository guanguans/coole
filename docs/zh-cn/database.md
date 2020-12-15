# 数据库

命令行 [topthink/think-orm](https://github.com/topthink/think-orm) 提供支持。

## 配置

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 `config/database.php` 配置。

``` php
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

## 使用，请参考[think-orm](https://www.kancloud.cn/manual/think-orm/1258001)
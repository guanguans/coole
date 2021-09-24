# cors

> 在 Coole 应用程序中添加 CORS（跨源资源共享）头支持。

## 安装

``` bash
$ composer require coolephp/cors -vvv
```

## 使用

1. 复制 `cors/config/cors.php` 到 `coole-skeleton/config/cors.php`.
2. 配置 `\Coole\Cors\Cors::class` 中间件.

```php
<?php

return [
    /*
     * App 名称
     */
    'name' => env('APP_NAME', 'Coole'),

    /*
     * 全局中间件
     */
    'middleware' => [
        ...
        \Coole\Cors\Cors::class
        ...
    ],
];
```

## 源码链接

* [https://github.com/coolephp/cors](https://github.com/coolephp/cors)

## 相关链接

* [https://github.com/asm89/stack-cors](https://github.com/asm89/stack-cors)
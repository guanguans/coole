# 快速开始

## 创建 `index.php` 文件

``` php
<?php

use Guanguans\Coole\App;
use Guanguans\Coole\Facade\Router;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';

// 创建 web 应用
$app = new App();

// 开启调试模式
$app['debug'] = true;

// 添加路由和路由中间件
Router::get('/', function (){
    return 'This is the Coole framework.';
})->setMiddleware(function (Request $request, Closure $next){
    printf('Before request.<br>');

    $response = $next($request);

    printf('<br>After request.');

    return $response;
});

// 启动运行 web 应用
$app->run();
```

## 使用 PHP 内置服务器进行测试

``` shell
$ php -S 127.0.0.1:8000
```

## 请求 `http://127.0.0.1:8000/`

## 响应

``` html
Before request.
This is the Coole framework.
After request.
```

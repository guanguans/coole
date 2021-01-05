# 路由

> 路由由 [symfony/routing](https://github.com/symfony/routing) 提供支持。

## 配置路由文件

默认 `config/app.php`。

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
    ...
    'route' => [
        // 路由文件所在目录或者路由文件
        base_path('route'),
    ],
    ...
];
```

## 路由文件

默认在 `route/web.php` 和 `route/api.php` 文件内完成的路由定义。

## 闭包路由

``` php
<?php

use Guanguans\Coole\Facade\Router;

Route::get('hello-coole', function () {
    return 'Hello Coole.';
});
```

## 标准路由

``` php
<?php

use Guanguans\Coole\Facade\Router;

Router::get('/hello-coole', [App\Controller\IndexController::class, 'hello']);
```

## 路由方法

``` php
<?php

use Guanguans\Coole\Facade\Router;

// 注册与方法名一致的 HTTP METHOD 的路由
Router::get($uri, $to);
Router::post($uri, $to);
Router::put($uri, $to);
Router::patch($uri, $to);
Router::delete($uri, $to);
Router::options($uri, $to);

// 注册任意 HTTP METHOD 的路由
Router::any($httpMethods, $uri, $to);
Router::match($httpMethods, $uri, $to);
```

## 路由组

``` php
<?php

use Guanguans\Coole\Facade\Router;

Router::prefix('/user/')->group(function (){
    Router::get('index', [App\Controller\UserController::class, 'index']);
    Router::post('store', [App\Controller\UserController::class, 'store']);
    Router::get('update', [App\Controller\UserController::class, 'update']);
    Router::post('delete', [App\Controller\UserController::class, 'delete']);
});
```

## 路由参数

### 路由文件中

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show']);
```

### 控制器中

``` php
<?php

public function show($id)
{
    dd($id);
}
```

### 路由中间件

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show'])->setMiddleware(App\Middlewa\DemoMiddleware::class);
```

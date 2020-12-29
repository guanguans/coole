# 中间件

> 中间件由 [mpociot/pipeline](https://github.com/mpociot/pipeline) 提供支持。

## 前置中间件

``` php
<?php

use Closure;
use Guanguans\Coole\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;

class BeforeRequest implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        dump('Before request.');

        return $next($request);
    }
}
```

## 后置中间件

``` php
<?php

use Closure;
use Guanguans\Coole\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;

class AfterRequest implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        dump('After request.');

        return $response;
    }
}
```

## 全局中间件

### 配置添加

默认在 `config/app.php` 文件内配置全局中间件。

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
    /*
     * 全局中间件
     */
    'middleware' => [
        // \App\Middleware\ExampleMiddleware::class
    ],
    ...
];

```

### 动态添加

``` php
``` php
$app->setMiddleware(\App\Middleware\ExampleMiddleware::class);
```

## 路由中间件

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show'])->setMiddleware(App\Middlewa\DemoMiddleware::class);
```

## 控制器中间件

``` php
<?php

namespace App\Controller;

use Guanguans\Coole\Controller\Controller;

class IndexController extends Controller
{
    protected $middleware = [
        App\Middlewa\DemoMiddleware::class
    ];
    
    public function hello($hello)
    {
        return sprintf('Hello %s', $hello);
    }
}
```

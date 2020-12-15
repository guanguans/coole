# 路由

路由由 [symfony/routing](https://github.com/symfony/routing) 提供支持。

## 通过配置文件定义路由

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 route/web.php 文件内完成的路由定义。

## 通过闭包定义路由

``` php
use Guanguans\Coole\Facade\Router;

Route::get('hello-coole', function () {
    return 'Hello Coole.';
});
```

## 定义标准路由

``` php
use Guanguans\Coole\Facade\Router;

Router::get('/hello-coole', [App\Controller\IndexController::class, 'hello']);
```

## 可用的路由方法

``` php
use Guanguans\Coole\Facade\Router;

// 注册与方法名一致的 HTTP METHOD 的路由
Router::get($uri, $to);
Router::post($uri, $to);
Router::put($uri, $to);
Router::patch($uri, $to);
Router::delete($uri, $to);
Router::options($uri, $to);

// 注册任意 HTTP METHOD 的路由
Router::any($httpMethod, $uri, $to);
Router::match($httpMethod, $uri, $to);
```

## 路由组的定义方式

``` php
use Guanguans\Coole\Facade\Router;

Router::prefix('/user/')->group(function (){
    Router::get('index', [App\Controller\UserController::class, 'index']);
    Router::post('store', [App\Controller\UserController::class, 'store']);
    Router::get('update', [App\Controller\UserController::class, 'update']);
    Router::post('delete', [App\Controller\UserController::class, 'delete']);
});
```

## 路由参数

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show']);
```

``` php
public function show($id)
{
    dd($id);
}
```
### 设置路由中间件

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show'])->setMiddleware(App\Middlewa\DemoMiddleware::class);
```

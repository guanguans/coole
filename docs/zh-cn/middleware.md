# 中间件

中间间由 [mpociot/pipeline](https://github.com/mpociot/pipeline) 提供支持。

## 一个中间件类必须实现 `Guanguans\Coole\Middleware\MiddlewareInterface` 接口

## 示例

``` php
use Closure;
use Symfony\Component\HttpFoundation\Request;

class BeforeRequest implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, Closure $next)
    {

        dump('Before request.');

        return $next($request);
    }
}
```

``` php
use Closure;
use Symfony\Component\HttpFoundation\Request;

class AfterRequest implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);

        dump('After request.');

        return $response;
    }
}
```

## 全局中间件

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 config/app.php 文件内配置全局中间件。

``` php
$app->addMiddleware(App\Middlewa\DemoMiddleware::class);
```

## 路由中间件

``` php
Router::get('/user/{id}', [App\Controller\UserController::class, 'show'])->setMiddleware(App\Middlewa\DemoMiddleware::class);
```

## 控制器中间件

``` php
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
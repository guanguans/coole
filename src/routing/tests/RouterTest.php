<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing\Tests;

use Coole\Foundation\App;
use Coole\Routing\Route;
use Coole\Routing\Router;
use Coole\Routing\RouteRegistrar;
use Nyholm\NSA;

class RouterTest extends TestCase
{
    private App $app;

    private Router $router;

    protected function setUp(): void
    {
        $this->app = new App();
        $this->router = new Router(new Route(), $this->app['routing.collection']);
    }

    public function testAny()
    {
        $route = $this->router->any([], '/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame([], $route->getMethods());

        $route = $this->router->any(['GET', 'POST'], '/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['GET', 'POST'], $route->getMethods());
    }

    public function testPost()
    {
        $route = $this->router->post('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['POST'], $route->getMethods());
    }

    public function testGet()
    {
        $route = $this->router->get('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['GET', 'HEAD'], $route->getMethods());
    }

    public function testPut()
    {
        $route = $this->router->put('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['PUT'], $route->getMethods());
    }

    public function testDelete()
    {
        $route = $this->router->delete('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['DELETE'], $route->getMethods());
    }

    public function testOptions()
    {
        $route = $this->router->options('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['OPTIONS'], $route->getMethods());
    }

    public function testPatch()
    {
        $route = $this->router->patch('/', static function () {
        });
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['PATCH'], $route->getMethods());
    }

    public function testCall()
    {
        $routeRegistrar = $this->router->prefix('/');
        $this->assertInstanceOf(RouteRegistrar::class, $routeRegistrar);
    }

    public function testUpdateGroupStack()
    {
        $isUpdateGroupStack = NSA::invokeMethod($this->router, 'updateGroupStack', [
            'prefix' => '/',
            'middleware' => ['middleware'],
        ]);

        $this->assertTrue($isUpdateGroupStack);
    }

    public function testGroup()
    {
        $router = $this->router->group([
            'prefix' => '/',
            'middleware' => ['middleware'],
        ], static function () {
            echo 'group';
        });

        $this->assertInstanceOf(Router::class, $router);
        $this->expectOutputString('group');
    }
}

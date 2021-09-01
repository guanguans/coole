<?php

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
    /**
     * @var \Coole\Foundation\App
     */
    private $app;

    /**
     * @var \Coole\Routing\Router
     */
    private $router;

    protected function setUp(): void
    {
        $this->app = new App();
        $this->router = new Router(new Route(), $this->app['route_collection']);
    }

    public function testAny()
    {
        $route = $this->router->any([], '/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame([], $route->getMethods());

        $route = $this->router->any(['GET', 'POST'], '/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['GET', 'POST'], $route->getMethods());
    }

    public function testPost()
    {
        $route = $this->router->post('/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['POST'], $route->getMethods());
    }

    public function testGet()
    {
        $route = $this->router->get('/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['GET', 'HEAD'], $route->getMethods());
    }

    public function testPut()
    {
        $route = $this->router->put('/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['PUT'], $route->getMethods());
    }

    public function testDelete()
    {
        $route = $this->router->delete('/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['DELETE'], $route->getMethods());
    }

    public function testOptions()
    {
        $route = $this->router->options('/', function () {});
        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['OPTIONS'], $route->getMethods());
    }

    public function testPatch()
    {
        $route = $this->router->patch('/', function () {});
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
        ], function () {
            echo 'group';
        });

        $this->assertInstanceOf(Router::class, $router);
        $this->expectOutputString('group');
    }
}

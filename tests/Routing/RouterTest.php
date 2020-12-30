<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests\Routing;

use Guanguans\Coole\Routing\Route;
use Guanguans\Coole\Routing\Router;
use Guanguans\Coole\Routing\RouteRegistrar;
use Guanguans\Coole\Tests\TestCase;

class RouterTest extends TestCase
{
    protected $router;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router(new Route(), $this->app['route_collection']);
    }

    public function testAny()
    {
        $route = $this->router->any('/', function () {
            return 'any';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame([], $route->getMethods());
    }

    public function testPost()
    {
        $route = $this->router->post('/', function () {
            return 'post';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['POST'], $route->getMethods());
    }

    public function testGet()
    {
        $route = $this->router->get('/', function () {
            return 'get';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['GET', 'HEAD'], $route->getMethods());
    }

    public function testPut()
    {
        $route = $this->router->put('/', function () {
            return 'put';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['PUT'], $route->getMethods());
    }

    public function testDelete()
    {
        $route = $this->router->delete('/', function () {
            return 'delete';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['DELETE'], $route->getMethods());
    }

    public function testOptions()
    {
        $route = $this->router->options('/', function () {
            return 'options';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['OPTIONS'], $route->getMethods());
    }

    public function testPatch()
    {
        $route = $this->router->patch('/', function () {
            return 'patch';
        });

        $this->assertInstanceOf(Route::class, $route);
        $this->assertSame(['PATCH'], $route->getMethods());
    }

    public function test__call()
    {
        $routeRegistrar = $this->router->prefix('/');
        $this->assertInstanceOf(RouteRegistrar::class, $routeRegistrar);
    }

    public function testUpdateGroupStack()
    {
        $router = new RouterStub(new Route(), $this->app['route_collection']);
        $router = $router->testUpdateGroupStack([
            'prefix' => '/',
            'middleware' => [self::class],
        ]);

        $this->assertTrue($router);
    }

    public function testGroup()
    {
        $router = $this->router->group([
            'prefix' => '/',
            'middleware' => [self::class],
        ], function () {
            echo 'group';
        });

        $this->assertInstanceOf(Router::class, $router);
        $this->expectOutputString('group');
    }
}

class RouterStub extends Router
{
    public function testUpdateGroupStack(array $attributes)
    {
        return $this->updateGroupStack($attributes);
    }
}

<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests;

use Guanguans\Coole\App;
use Guanguans\Coole\Controller\Controller;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Tightenco\Collect\Support\Collection;

class AppTest extends TestCase
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = new App();
    }

    public function testConstruct()
    {
        $app = new App($options = [
            'debug' => true,
            'charset' => 'UTF-8',
        ]);

        $this->assertSame($app['debug'], $options['debug']);
        $this->assertSame($app['charset'], $options['charset']);
        $this->assertSame($app, $app::getInstance());
    }

    public function testVersion()
    {
        $this->assertIsString($this->app::version());
    }

    public function testMergeConfig()
    {
        $app = new App();
        $app->addConfig([
            'mock_key' => $mock_value1 = [
                'mock_value1',
            ],
        ]);

        $app->mergeConfig([
            'mock_key' => $mock_value2 = [
                'mock_value2',
            ],
        ]);

        $this->assertInstanceOf(Collection::class, $app['config']['mock_key']);
        $this->assertSame($app['config']['mock_key']->toArray(), $mock_value2);
    }

    public function testAddConfig()
    {
        $app = new App();
        $app->addConfig([
            'mock_key' => $mock_value1 = [
                'mock_value1',
            ],
        ]);

        $app->addConfig([
            'mock_key' => $mock_value2 = [
                'mock_value2',
            ],
        ]);

        $this->assertInstanceOf(Collection::class, $app['config']['mock_key']);
        $this->assertSame($app['config']['mock_key']->toArray(), $mock_value1);
    }

    public function testAddMiddleware()
    {
        $app = new App();

        $app->addMiddleware(MiddlewareStub::class);

        $middleware = $app->getMiddleware();

        $this->assertSame(end($middleware), MiddlewareStub::class);
    }

    public function testAddOption()
    {
        $app = new App();

        $app->addOption($options = [
            'debug' => true,
            'charset' => 'UTF-8',
        ]);

        $this->assertSame($app['debug'], $options['debug']);
        $this->assertSame($app['charset'], $options['charset']);
    }

    public function testGetControllerMiddleware()
    {
        $app = new App();
        $app['router']->get('/', function () {});
        $request = Request::createFromGlobals();
        $controllerMiddleware = $app->getControllerMiddleware($request);
        $this->assertIsArray($controllerMiddleware);
        $this->assertEmpty($controllerMiddleware);
    }

    public function testGetRouteMiddleware()
    {
        $app = new App();
        $app['router']->get('/', function () {})->setMiddleware(MiddlewareStub::class);
        $request = Request::createFromGlobals();
        $routeMiddleware = $app->getRouteMiddleware($request);
        $this->assertIsArray($routeMiddleware);
        $this->assertSame(MiddlewareStub::class, end($routeMiddleware));
    }

    public function testGetAllMiddleware()
    {
        $app = new App();
        $app['router']->get('/', function () {})->setMiddleware(MiddlewareStub::class);
        $request = Request::createFromGlobals();
        $allMiddleware = $app->getAllMiddleware($request);
        $this->assertIsArray($allMiddleware);
    }

    public function testMakeAllMiddleware()
    {
        $middlewares = $this->app->makeAllMiddleware(MiddlewareStub::class);

        $this->assertIsArray($middlewares);

        foreach ($middlewares as $middleware) {
            $this->assertIsObject($middleware);
        }
    }

    public function testRegister()
    {
        $app = $this->app->register(new ServiceProviderStub());
        $this->assertIsObject($app);
    }

    public function testBoot()
    {
        $app = new SubAppStub();
        $this->assertFalse($app->getBooted());
        $app->boot();
        $this->assertTrue($app->getBooted());
    }
}

class MiddlewareStub
{
}

class SubAppStub extends App
{
    public function getBooted()
    {
        return $this->booted;
    }
}

class ControllerStub extends Controller
{
    public function hello()
    {
    }
}

class ServiceProviderStub implements ServiceProviderInterface
{
    public function register(Container $container)
    {
    }
}

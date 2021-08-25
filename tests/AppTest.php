<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests;

use Guanguans\Coole\App;
use Guanguans\Coole\Controller\Controller;
use Guanguans\Coole\Exception\UnknownFileException;
use Guanguans\Coole\Provider\TwigServiceProvider;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Tightenco\Collect\Support\Collection;

class AppTest extends TestCase
{
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

    public function testAddOption()
    {
        $app = new App();

        $app->addOptions($options = [
            'debug' => true,
            'charset' => 'UTF-8',
        ]);

        $this->assertSame($app['debug'], $options['debug']);
        $this->assertSame($app['charset'], $options['charset']);
    }

    public function testAddMiddleware()
    {
        $app = new App();

        $app->setMiddleware(MiddlewareStub::class);

        $middleware = $app->getMiddleware();

        $this->assertSame(end($middleware), MiddlewareStub::class);
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

    public function testGetCurrentRequestShouldExecutedMiddleware()
    {
        $app = new App();
        $app['router']->get('/', function () {})->setMiddleware(MiddlewareStub::class);
        $request = Request::createFromGlobals();
        $allMiddleware = $app->getCurrentRequestShouldExecutedMiddleware($request);
        $this->assertIsArray($allMiddleware);
    }

    public function testGetCurrentController()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $request = Request::createFromGlobals();
        $controller = $app->getCurrentController($request);
        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testGetControllerMiddleware()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $request = Request::createFromGlobals();
        $controlleMiddleware = $app->getControllerMiddleware($request);
        $this->assertIsArray($controlleMiddleware);
        $this->assertSame(MiddlewareStub::class, end($controlleMiddleware));
    }

    public function testGetControllerExcludedMiddleware()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $request = Request::createFromGlobals();
        $controlleMiddleware = $app->getControllerExcludedMiddleware($request);
        $this->assertIsArray($controlleMiddleware);
        $this->assertSame(MiddlewareStub::class, end($controlleMiddleware));
    }

    public function testMakeMiddleware()
    {
        $middlewares = $this->app->makeMiddleware(MiddlewareStub::class);

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
        $app = new AppStub();

        $this->assertFalse($app->getBooted());
        $app->boot();
        $this->assertTrue($app->getBooted());

        $app->setBooted(true);

        $this->assertNull($app->boot());
    }

    public function testLoadEnv()
    {
        $loadEnv = $this->app->loadEnv(__DIR__.'/feature');
        $this->assertInstanceOf(App::class, $loadEnv);
    }

    public function testLoadConfig()
    {
        $loadConfig = $this->app->loadConfig(__DIR__.'/feature/config');
        $this->assertInstanceOf(App::class, $loadConfig);

        $loadConfig = $this->app->loadConfig(__DIR__.'/feature/config/app.php');
        $this->assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadConfigException()
    {
        $this->expectException(UnknownFileException::class);
        $this->app->loadConfig(__DIR__.'/feature/confi');
    }

    public function testLoadRoute()
    {
        $loadConfig = $this->app->loadRoute(__DIR__.'/feature/config');
        $this->assertInstanceOf(App::class, $loadConfig);

        $loadConfig = $this->app->loadRoute(__DIR__.'/feature/config/app.php');
        $this->assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadRouteException()
    {
        $this->expectException(UnknownFileException::class);
        $this->app->loadRoute(__DIR__.'/feature/confi');
    }

    public function testAddFinishHandler()
    {
        $addFinishListener = $this->app->addFinishHandler(function () {
            return __FUNCTION__;
        });

        $this->assertInstanceOf(App::class, $addFinishListener);
    }

    public function testSetFinishHandler()
    {
        $addFinishListener = $this->app->setFinishHandler(function () {
            return __FUNCTION__;
        });

        $this->assertInstanceOf(App::class, $addFinishListener);
    }

    public function testRender()
    {
        $this->app->mergeConfig([
            'view' => [
                'path' => __DIR__.'/feature/view/',
            ],
        ]);

        $this->markTestSkipped('Github action is not available.');

        $this->app->register(new TwigServiceProvider());
        $render = $this->app->render('index.twig');
        $this->assertIsString($render);
    }
}

class MiddlewareStub
{
}

class AppStub extends App
{
    public function getBooted()
    {
        return $this->booted;
    }

    public function setBooted($value)
    {
        $this->booted = $value;

        return $this;
    }
}

class ControllerStub extends Controller
{
    protected $middleware = [
        MiddlewareStub::class,
    ];

    protected $excludedMiddleware = [
        MiddlewareStub::class,
    ];

    public function hello()
    {
    }
}

class InvalidControllerStub
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

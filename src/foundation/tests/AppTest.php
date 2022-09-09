<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests;

use Coole\Foundation\App;
use Coole\Foundation\Exceptions\UnknownFileOrDirectoryException;
use Coole\Foundation\Tests\Stub\AppStub;
use Coole\Foundation\Tests\Stub\ControllerStub;
use Coole\Foundation\Tests\Stub\MiddlewareStub;
use Coole\Foundation\Tests\Stub\ServiceProviderStub;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Request;

class AppTest extends TestCase
{
    private App $app;

    protected function setUp(): void
    {
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
            'key' => $val1 = ['val1'],
        ]);

        $app->mergeConfig([
            'key' => $val2 = ['val2'],
        ]);

        $this->assertInstanceOf(Collection::class, $app['config']['key']);
        $this->assertSame($app['config']['key']->toArray(), $val2);
    }

    public function testAddConfig()
    {
        $app = new App();
        $app->addConfig([
            'key' => $val1 = ['val1'],
        ]);

        $app->addConfig([
            'key' => $val2 = ['val2'],
        ]);

        $this->assertInstanceOf(Collection::class, $app['config']['key']);
        $this->assertSame($app['config']['key']->toArray(), $val1);
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
        $app['router']->get('/', static function () {
        })->setMiddleware(MiddlewareStub::class);
        $routeMiddleware = $app->getRouteMiddleware(Request::createFromGlobals());
        $this->assertIsArray($routeMiddleware);
        $this->assertSame(MiddlewareStub::class, end($routeMiddleware));
    }

    public function testGetCurrentRequestShouldExecutedMiddleware()
    {
        $app = new App();
        $app['router']->get('/', static function () {
        })->setMiddleware(MiddlewareStub::class);
        $allMiddleware = $app->getCurrentRequestShouldExecutedMiddleware(Request::createFromGlobals());
        $this->assertIsArray($allMiddleware);
    }

    public function testGetCurrentController()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $controller = $app->getCurrentController(Request::createFromGlobals());
        $this->assertInstanceOf(ControllerStub::class, $controller);
    }

    public function testGetControllerMiddleware()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $controlleMiddleware = $app->getControllerMiddleware(Request::createFromGlobals());
        $this->assertIsArray($controlleMiddleware);
        $this->assertSame(MiddlewareStub::class, end($controlleMiddleware));
    }

    public function testGetControllerExcludedMiddleware()
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $controlleMiddleware = $app->getControllerExcludedMiddleware(Request::createFromGlobals());
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
        $appStub = new AppStub();

        $this->assertFalse($appStub->getBooted());
        $appStub->boot();
        $this->assertTrue($appStub->getBooted());

        $appStub->setBooted(true);

        $this->assertNull($appStub->boot());
    }

    public function testLoadEnv()
    {
        $loadEnv = null;
        $this->markTestSkipped(__METHOD__);
        $loadEnv = $this->app->loadEnvsFrom(__DIR__.'/Stub');
        $this->assertInstanceOf(App::class, $loadEnv);
    }

    public function testLoadConfig()
    {
        $loadConfig = $this->app->loadConfigsFrom(__DIR__.'/Stub/config');
        $this->assertInstanceOf(App::class, $loadConfig);

        $loadConfig = $this->app->loadConfigsFrom(__DIR__.'/Stub/config/app.php');
        $this->assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadConfigException()
    {
        $this->expectException(UnknownFileOrDirectoryException::class);
        $this->app->loadConfigsFrom(__DIR__.'/Stub/conf');
    }

    public function testLoadRoute()
    {
        $loadConfig = $this->app->loadRoutesFrom(__DIR__.'/Stub/config');
        $this->assertInstanceOf(App::class, $loadConfig);

        $loadConfig = $this->app->loadRoutesFrom(__DIR__.'/Stub/config/app.php');
        $this->assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadRouteException()
    {
        $this->expectException(UnknownFileOrDirectoryException::class);
        $this->app->loadRoutesFrom(__DIR__.'/Stub/conf');
    }
}

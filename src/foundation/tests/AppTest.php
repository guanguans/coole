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

    public function testConstruct(): void
    {
        $app = new App($options = [
            'debug' => true,
            'charset' => 'UTF-8',
        ]);

        self::assertSame($app['debug'], $options['debug']);
        self::assertSame($app['charset'], $options['charset']);
        self::assertSame($app, $app::getInstance());
    }

    public function testVersion(): void
    {
        self::assertIsString($this->app::version());
    }

    public function testMergeConfig(): void
    {
        // $app = new App();
        // $app->addConfig('key', $val1 = ['val1']);
        //
        // $app->mergeConfig('key', $val2 = ['val2']);
        //
        // self::assertInstanceOf(Collection::class, $app['config']['key']);
        // self::assertSame($app['config']['key']->toArray(), $val2);
    }

    public function testAddConfig(): void
    {
        // $app = new App();
        // $app->addConfig('key', $val1 = ['val1']);
        //
        // $app->mergeConfig('key', $val2 = ['val2']);
        //
        // self::assertInstanceOf(Collection::class, $app['config']['key']);
        // self::assertSame($app['config']['key']->toArray(), $val1);
    }

    public function testAddOption(): void
    {
        // $app = new App();
        //
        // $app->setOptions($options = [
        //     'debug' => true,
        //     'charset' => 'UTF-8',
        // ]);
        //
        // self::assertSame($app['debug'], $options['debug']);
        // self::assertSame($app['charset'], $options['charset']);
    }

    public function testAddMiddleware(): void
    {
        $app = new App();

        $app->setMiddleware(MiddlewareStub::class);

        $middleware = $app->getMiddleware();

        self::assertSame(end($middleware), MiddlewareStub::class);
    }

    public function testGetRouteMiddleware(): void
    {
        // $app = new App();
        // $app['router']->get('/', static function (): void {
        // })->setMiddleware(MiddlewareStub::class);
        // $routeMiddleware = $app->getRouteMiddleware(Request::createFromGlobals());
        // self::assertIsArray($routeMiddleware);
        // self::assertSame(MiddlewareStub::class, end($routeMiddleware));
    }

    public function testGetCurrentRequestShouldExecutedMiddleware(): void
    {
        // $app = new App();
        // $app['router']->get('/', static function (): void {
        // })->setMiddleware(MiddlewareStub::class);
        // $allMiddleware = $app->getShouldExecutedRequestMiddleware(Request::createFromGlobals());
        // self::assertIsArray($allMiddleware);
    }

    public function testGetCurrentController(): void
    {
        $app = new App();
        $app['router']->get('/', [ControllerStub::class, 'hello']);
        $controller = $app->getController(Request::createFromGlobals());
        self::assertInstanceOf(ControllerStub::class, $controller);
    }

    public function testGetControllerMiddleware(): void
    {
        // $app = new App();
        // $app['router']->get('/', [ControllerStub::class, 'hello']);
        // $controlleMiddleware = $app->getControllerMiddleware(Request::createFromGlobals());
        // self::assertIsArray($controlleMiddleware);
        // self::assertSame(MiddlewareStub::class, end($controlleMiddleware));
    }

    public function testGetControllerExcludedMiddleware(): void
    {
        // $app = new App();
        // $app['router']->get('/', [ControllerStub::class, 'hello']);
        // $controlleMiddleware = $app->getWithoutControllerMiddleware(Request::createFromGlobals());
        // self::assertIsArray($controlleMiddleware);
        // self::assertSame(MiddlewareStub::class, end($controlleMiddleware));
    }

    public function testMakeMiddleware(): void
    {
        // $middlewares = $this->app->makeMiddleware(MiddlewareStub::class);
        //
        // self::assertIsArray($middlewares);
        //
        // foreach ($middlewares as $middleware) {
        //     self::assertIsObject($middleware);
        // }
    }

    public function testRegister(): void
    {
        // $app = $this->app->register(new ServiceProviderStub());
        // self::assertNull($app);
    }

    public function testBoot(): void
    {
        // $appStub = new AppStub();
        //
        // self::assertFalse($appStub->getBooted());
        // $appStub->boot();
        // self::assertTrue($appStub->getBooted());
        //
        // $appStub->setBooted(true);
        //
        // self::assertNull($appStub->boot());
    }

    public function testLoadEnv(): void
    {
        // $this->markTestSkipped(__METHOD__);
        // $loadEnv = $this->app->loadEnvsFrom(__DIR__.'/Stub');
        // self::assertInstanceOf(App::class, $loadEnv);
    }

    public function testLoadConfig(): void
    {
        // $loadConfig = $this->app->loadConfigsFrom(__DIR__.'/Stub/config');
        // self::assertInstanceOf(App::class, $loadConfig);
        //
        // $loadConfig = $this->app->loadConfigsFrom(__DIR__.'/Stub/config/app.php');
        // self::assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadConfigException(): void
    {
        $this->expectException(UnknownFileOrDirectoryException::class);
        $this->app->loadConfigFrom(__DIR__.'/Stub/conf');
    }

    public function testLoadRoute(): void
    {
        // $loadConfig = $this->app->loadRoutesFrom(__DIR__.'/Stub/config');
        // self::assertInstanceOf(App::class, $loadConfig);
        //
        // $loadConfig = $this->app->loadRoutesFrom(__DIR__.'/Stub/config/app.php');
        // self::assertInstanceOf(App::class, $loadConfig);
    }

    public function testLoadRouteException(): void
    {
        $this->expectException(UnknownFileOrDirectoryException::class);
        $this->app->loadRouteFrom(__DIR__.'/Stub/conf');
    }
}

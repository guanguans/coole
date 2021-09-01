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

class RouteRegistrarTest extends TestCase
{
    /**
     * @var \Coole\Foundation\App
     */
    private $app;

    /**
     * @var \Coole\Routing\RouteRegistrar
     */
    private $routeRegistrar;

    protected function setUp(): void
    {
        $this->app = new App();
        $this->routeRegistrar = new RouteRegistrar(new Router(new Route(), $this->app['route_collection']));
    }

    public function testPrefix()
    {
        $this->assertInstanceOf(RouteRegistrar::class, $this->routeRegistrar->prefix('api'));
    }

    public function testMiddleware()
    {
        $this->assertInstanceOf(RouteRegistrar::class, $this->routeRegistrar->middleware('middleware'));
    }

    public function testGroup()
    {
        $routeRegistrar = $this->routeRegistrar->group(function () {
            echo 'group';
        });
        $this->assertInstanceOf(RouteRegistrar::class, $routeRegistrar);
        $this->expectOutputString('group');
    }
}

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
    private App $app;

    private RouteRegistrar $routeRegistrar;

    protected function setUp(): void
    {
        $this->app = new App();
        $this->routeRegistrar = new RouteRegistrar(new Router(new Route(), $this->app['routing.collection']));
    }

    public function testPrefix(): void
    {
        $this->assertInstanceOf(RouteRegistrar::class, $this->routeRegistrar->prefix('api'));
    }

    public function testMiddleware(): void
    {
        $this->assertInstanceOf(RouteRegistrar::class, $this->routeRegistrar->middleware('middleware'));
    }

    public function testGroup(): void
    {
        $routeRegistrar = $this->routeRegistrar->group(static function (): void {
            echo 'group';
        });
        $this->assertInstanceOf(RouteRegistrar::class, $routeRegistrar);
        $this->expectOutputString('group');
    }
}

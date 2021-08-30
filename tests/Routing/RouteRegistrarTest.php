<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Guanguans\Coole\Tests\Routing;

use Guanguans\Coole\Routing\Route;
use Guanguans\Coole\Routing\Router;
use Guanguans\Coole\Routing\RouteRegistrar;
use Guanguans\Coole\Tests\TestCase;

class RouteRegistrarTest extends TestCase
{
    protected $router;

    protected $routeRegistrar;

    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router(new Route(), $this->app['route_collection']);

        $this->routeRegistrar = new RouteRegistrar($this->router);
    }

    public function testMiddleware()
    {
        $this->assertInstanceOf(RouteRegistrar::class, $this->routeRegistrar->middleware(self::class));
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

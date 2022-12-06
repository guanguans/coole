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
use Symfony\Component\Routing\RouteCollection;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will not return for `attribute`.', function (): void {
    expect(new RouteRegistrar(mock(Router::class)->makePartial()))
        ->attribute('attribute', 'value');
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class);

it('will return self for `attribute`.', function (): void {
    expect(new RouteRegistrar(mock(Router::class)->makePartial()))
        ->attribute('withoutMiddleware', 'MiddlewareName')
        ->toBeInstanceOf(RouteRegistrar::class);
})->group(__DIR__, __FILE__);

it('will not return for `group`.', function (): void {
    expect(new RouteRegistrar(mock(Router::class)->makePartial()))
        ->group(function (Router $router): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will return `Route` for `match`.', function (): void {
    $router = mock(Router::class)
        ->shouldReceive('match')
        ->andReturn(new Route())
        ->getMock();

    expect((new RouteRegistrar($router))->match('get', 'uri', function (): void {}))
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `__call`.', function (): void {
    $router = new Router(new Route(), new RouteCollection());
    expect(new RouteRegistrar($router))
        ->get('uri', function (): void {})
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return self for `__call`.', function (): void {
    $router = new Router(new Route(), new RouteCollection());

    expect(new RouteRegistrar($router))
        ->withoutMiddleware('foo')
        ->toBeInstanceOf(RouteRegistrar::class)
        ->name('foo')
        ->toBeInstanceOf(RouteRegistrar::class);
})->group(__DIR__, __FILE__);

it('will throws `BadMethodCallException` for `__call`.', function (): void {
    $router = new Router(new Route(), new RouteCollection());

    expect(new RouteRegistrar($router))
        ->foo('foo');
})->group(__DIR__, __FILE__)->throws(\BadMethodCallException::class);

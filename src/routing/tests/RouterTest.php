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
    $this->router = new Router(new Route(), new RouteCollection());
});

it('will return `Route` for `any`.', function (): void {
    expect($this->router)
        ->any('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `get`.', function (): void {
    expect($this->router)
        ->get('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `post`.', function (): void {
    expect($this->router)
        ->post('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `put`.', function (): void {
    expect($this->router)
        ->put('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `delete`.', function (): void {
    expect($this->router)
        ->delete('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `options`.', function (): void {
    expect($this->router)
        ->options('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will return `Route` for `patch`.', function (): void {
    expect($this->router)
        ->patch('uri', 'callback')
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

it('will call method of RouteRegistrar for `__call`.', function (): void {
    expect($this->router)
        ->attribute('name', 'bar')
        ->toBeInstanceOf(RouteRegistrar::class);
})->group(__DIR__, __FILE__);

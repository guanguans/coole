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
use Coole\Foundation\ServiceProvider;
use Coole\HttpKernel\Controller;
use Coole\HttpKernel\Tests\stubs\ExampleInvokeControllerStub;
use Coole\Routing\Facades\Router;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will not return for `register`.', function (): void {
    expect($this->app)
        ->register(
            new class($this->app) extends ServiceProvider {
                protected array $classAliases = [
                    ServiceProvider::class => ['ServiceProvider', 'Provider'],
                ];
            }
        )
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `boot`.', function (): void {
    expect($this->app)
        ->boot()->toBeNull()
        ->boot()->toBeNull();
})->group(__DIR__, __FILE__);

it('will throws UnknownFileOrDirectoryException for `loadConfigFrom`.', function (): void {
    $this->app->loadConfigFrom('file');
})->group(__DIR__, __FILE__)->throws(UnknownFileOrDirectoryException::class);

it('will not return for `loadConfigFrom`.', function (): void {
    expect($this->app)
        ->loadConfigFrom(__DIR__.'/../../foundation/config')->toBeNull();
})->group(__DIR__, __FILE__);

it('will throws UnknownFileOrDirectoryException for `loadRouteFrom`.', function (): void {
    $this->app->loadRouteFrom('file');
})->group(__DIR__, __FILE__)->throws(UnknownFileOrDirectoryException::class);

it('will not return for `loadRouteFrom`.', function (): void {
    expect($this->app)
        ->loadRouteFrom(__DIR__.'/stubs')->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `run`.', function (): void {
    expect($this->app)
        ->run()->toBeNull();
})->group(__DIR__, __FILE__);

it('will return bool for `isBooted`.', function (): void {
    expect($this->app)
        ->isBooted()->toBeBool();
})->group(__DIR__, __FILE__);

it('will return `Response` for `handle`.', function (): void {
    Router::get('/', ExampleInvokeControllerStub::class);

    $m = mock(Request::class);
    $request = $m->shouldReceive('getPathInfo')
        ->andSet('headers', new HeaderBag())
        ->andReturn('/two')
        ->getMock();

    expect($this->app)
        ->handle($request)->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__)->skip(sprintf('%s@handle', __FILE__));

it('will return array for `getShouldExecutedRequestMiddleware`.', function (): void {
    Router::get('one', ExampleInvokeControllerStub::class);

    $m = mock(Request::class);
    $request = $m->shouldReceive('getPathInfo')
        ->andReturn('/one')
        ->getMock();

    expect($this->app)
        ->getShouldExecutedRequestMiddleware($request)->toBeArray();
})->group(__DIR__, __FILE__);

it('will return `Controller|null` for `getController`.', function (): void {
    Router::get('two', ExampleInvokeControllerStub::class);

    $m = mock(Request::class);
    $request = $m->shouldReceive('getPathInfo')
        ->andReturn('/two')
        ->getMock();

    expect($this->app)
        ->getController($request)->toBeInstanceOf(Controller::class);
})->group(__DIR__, __FILE__)->skip(sprintf('%s@getController', __FILE__));

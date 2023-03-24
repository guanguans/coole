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
use Coole\Foundation\Config;
use Coole\Foundation\Exceptions\UnknownFileOrDirectoryException;
use Coole\Foundation\ServiceProvider;
use Coole\HttpKernel\Controller;
use Coole\HttpKernel\Tests\stubs\ExampleControllerStub;
use Coole\HttpKernel\Tests\stubs\ExampleInvokeControllerStub;
use Coole\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Faker\faker;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
    // $this->app[Config::class]->set('app.debug', true);
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

it('will return `Response` for `sendRequestThroughPipeline`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), ExampleInvokeControllerStub::class);

    expect($this->app)
        ->sendRequestThroughPipeline(Request::create($uri))
        ->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will return array for `getShouldExecutedRequestMiddleware`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), ExampleInvokeControllerStub::class);

    expect($this->app)
        ->getShouldExecutedRequestMiddleware(Request::create($uri))
        ->toBeArray();
})->group(__DIR__, __FILE__);

it('will return array for `getControllerMiddleware || getWithoutControllerMiddleware`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), fn () => 'Closure');

    expect($this->app)
        ->getControllerMiddleware(Request::create($uri))
        ->toBeArray()
        ->getWithoutControllerMiddleware(Request::create($uri))
        ->toBeArray();
})->group(__DIR__, __FILE__);

it('will return `Controller|null` for `getController`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), ExampleInvokeControllerStub::class);
    expect($this->app)
        ->getController(Request::create($uri))
        ->toBeInstanceOf(Controller::class);

    $this->app[Router::class]
        ->get($uri = faker()->uuid(), $this->app->make(ExampleInvokeControllerStub::class));
    expect($this->app)
        ->getController(Request::create($uri))
        ->toBeInstanceOf(Controller::class);

    $this->app[Router::class]
        ->get($uri = faker()->uuid(), [
            ExampleControllerStub::class,
            'exampleMethod',
        ]);
    expect($this->app)
        ->getController(Request::create($uri))
        ->toBeInstanceOf(Controller::class);
})->group(__DIR__, __FILE__);

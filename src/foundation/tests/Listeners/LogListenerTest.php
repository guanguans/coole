<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Listeners;

use Coole\Foundation\App;
use Coole\Foundation\Config;
use Coole\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use function Pest\Faker\faker;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
    $this->app[Config::class]->set('app.debug', true);
});

it('will not return for `onKernelRequest || onKernelResponse`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), fn () => new RedirectResponse(faker()->url()));
    expect($this->app)
        ->run(Request::create($uri))
        ->toBeNull()
        ->handle(Request::create($uri), HttpKernelInterface::SUB_REQUEST)
        ->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will not return for `onKernelException`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), fn () => $this->app->make('xxx'));
    expect($this->app)
        ->run(Request::create($uri))
        ->toBeNull();

    $this->app[Router::class]
        ->get($uri = faker()->uuid(), fn () => throw new HttpException(400));
    expect($this->app)
        ->run(Request::create($uri))
        ->toBeNull();
})->group(__DIR__, __FILE__);

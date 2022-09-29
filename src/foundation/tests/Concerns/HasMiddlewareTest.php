<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Concerns;

use Coole\Foundation\App;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will return array for `getMiddleware`.', function (): void {
    expect($this->app)
        ->getMiddleware()->toBeArray();
})->group(__DIR__, __FILE__);

it('will return self for `addMiddleware`.', function (): void {
    expect($this->app)
        ->addMiddleware(fn ($request, $next) => $next($request))->toBeInstanceOf(App::class);
})->group(__DIR__, __FILE__);

it('will return array for `getWithoutMiddleware`.', function (): void {
    expect($this->app)
        ->getWithoutMiddleware()->toBeArray();
})->group(__DIR__, __FILE__);

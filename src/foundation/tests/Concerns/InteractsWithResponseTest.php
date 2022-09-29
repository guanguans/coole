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

use function Pest\Faker\faker;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will return `Response` for `response`.', function (): void {
    expect($this->app)
        ->response()->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will return `JsonResponse` for `json`.', function (): void {
    expect($this->app->json())->toBeInstanceOf(JsonResponse::class);
})->group(__DIR__, __FILE__);

it('will return `RedirectResponse` for `redirect`.', function (): void {
    expect($this->app)
        ->redirect(faker()->url())->toBeInstanceOf(RedirectResponse::class);
})->group(__DIR__, __FILE__);

it('will return `StreamedResponse` for `stream`.', function (): void {
    expect($this->app)
        ->stream()->toBeInstanceOf(StreamedResponse::class);
})->group(__DIR__, __FILE__);

it('will return `BinaryFileResponse` for `sendFile`.', function (): void {
    expect($this->app)
        ->sendFile(__FILE__)->toBeInstanceOf(BinaryFileResponse::class);
})->group(__DIR__, __FILE__);

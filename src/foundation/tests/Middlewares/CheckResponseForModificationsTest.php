<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Middlewares;

use Coole\Foundation\Middlewares\CheckResponseForModifications;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

it('will return `Response` for `handle`.', function (): void {
    expect(new CheckResponseForModifications())
        ->handle(app(Request::class), fn () => new Response())->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

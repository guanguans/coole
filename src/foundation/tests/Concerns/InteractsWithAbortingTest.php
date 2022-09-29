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
use Symfony\Component\HttpKernel\Exception\HttpException;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will throws `HttpException` for `abort`.', function (): void {
    expect($this->app)->abort(403);
})->group(__DIR__, __FILE__)->throws(HttpException::class);

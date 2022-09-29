<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Facades;

use Coole\Foundation\Facades\App;

it('will return string for `getFacadeAccessor`.', function (): void {
    expect(invade(new App()))
        ->getFacadeAccessor()
        ->toBeString();
})->group(__DIR__, __FILE__);

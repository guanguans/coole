<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing\Tests\Facades;

use Coole\Routing\Facades\Router;

it('will return string for `getFacadeAccessor`.', function (): void {
    expect(invade(new Router()))
        ->getFacadeAccessor()
        ->toBeString();
})->group(__DIR__, __FILE__);

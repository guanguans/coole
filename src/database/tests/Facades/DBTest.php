<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Database\Tests\Facades;

use Coole\Database\Facades\DB;

it('will return string for `getFacadeAccessor`.', function (): void {
    expect(invade(new DB()))
        ->getFacadeAccessor()
        ->toBeString();
});

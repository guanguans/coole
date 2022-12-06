<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Tests\Whoops;

use Coole\ErrorHandler\Whoops\WhoopsExceptionRenderer;

it('will return string for `render`.', function (): void {
    expect(new WhoopsExceptionRenderer())
        ->render(mock(\Exception::class)->makePartial())
        ->toBeString();
})->group(__DIR__, __FILE__);

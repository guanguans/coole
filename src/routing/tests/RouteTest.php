<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing\Tests;

use Coole\Routing\Route;

use function Pest\Faker\faker;

it('will return value of getter for `setName`.', function (): void {
    expect(new Route())
        ->setName($name = faker()->name())
        ->toBeInstanceOf(Route::class)
        ->getName()
        ->toBe($name);
})->group(__DIR__, __FILE__);

it('will return self for `name`.', function (): void {
    expect(new Route())
        ->name(faker()->name())
        ->toBeInstanceOf(Route::class);
})->group(__DIR__, __FILE__);

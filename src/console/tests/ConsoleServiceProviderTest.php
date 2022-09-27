<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Tests;

use Coole\Console\ConsoleServiceProvider;
use Coole\Foundation\App;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will not return for `boot`.', function (): void {
    expect(new ConsoleServiceProvider($this->app))
        ->boot()
        ->toBeNull();
})->group(__DIR__, __FILE__);

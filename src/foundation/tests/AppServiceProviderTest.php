<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests;

use Coole\Foundation\App;
use Coole\Foundation\AppServiceProvider;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will not return for `boot`.', function (): void {
    $this->app['config']['app.debug'] = true;
    expect(new AppServiceProvider($this->app))
        ->boot()->toBeNull();
})->group(__DIR__, __FILE__);

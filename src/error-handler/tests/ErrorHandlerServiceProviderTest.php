<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Tests;

use Coole\ErrorHandler\ErrorHandlerServiceProvider;
use Coole\Foundation\App;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
    $this->app['config']->set('app.debug', true);
    $this->app['config']->set('app.debug_blacklist', [
        'key' => [
            'secret',
        ],
    ]);
    $this->app['config']->set('app.editor', 'phpstorm');
});

it('will not return for `registered`.', function (): void {
    expect(new ErrorHandlerServiceProvider($this->app))
        ->registered()
        ->toBeNull();
})->group(__DIR__, __FILE__);

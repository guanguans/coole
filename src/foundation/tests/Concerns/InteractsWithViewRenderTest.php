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

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will return string for `render`.', function (): void {
    $this->app['config']['view.paths'] = __DIR__;
    expect($this->app)
        ->render(pathinfo(__FILE__, PATHINFO_BASENAME))->toBeString();
})->group(__DIR__, __FILE__);

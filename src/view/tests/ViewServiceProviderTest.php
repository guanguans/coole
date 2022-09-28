<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\View\Tests;

use Coole\Foundation\App;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will not return for `register`.', function (): void {
    $this->app['config']['view.paths'] = __DIR__;

    expect($this->app[LoaderInterface::class])
        ->toBeInstanceOf(LoaderInterface::class)
        ->and($this->app[Environment::class])
        ->toBeInstanceOf(Environment::class);
})->group(__DIR__, __FILE__);

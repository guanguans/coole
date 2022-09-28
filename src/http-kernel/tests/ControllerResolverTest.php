<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Tests;

use Coole\Foundation\App;
use Coole\HttpKernel\ControllerResolver;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will return callable for `createController`.', function (): void {
    expect(invade(new ControllerResolver()))
        ->createController('Coole\HttpKernel\Tests\stubs\ExampleControllerStub::exampleMethod')
        ->toBeCallable()
        ->createController('Coole\HttpKernel\Tests\stubs\ExampleControllerStub@exampleMethod')
        ->toBeCallable()
        ->createController('Coole\HttpKernel\Tests\stubs\ExampleInvokeControllerStub')
        ->toBeCallable();
})->group(__DIR__, __FILE__);

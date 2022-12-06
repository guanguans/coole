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
use Coole\HttpKernel\ArgumentResolver;
use Coole\HttpKernel\Tests\stubs\ExampleControllerStub;
use Coole\HttpKernel\Tests\stubs\ExampleInvokeControllerStub;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will throws `InvalidArgumentException` for `getArguments`.', function (): void {
    expect(new ArgumentResolver(argumentValueResolvers: [
        new class() implements ArgumentValueResolverInterface {
            public function supports(Request $request, ArgumentMetadata $argument): bool
            {
                return true;
            }

            public function resolve(Request $request, ArgumentMetadata $argument): iterable
            {
                return [];
            }
        },
    ]))
        ->getArguments(Request::createFromGlobals(), new ExampleInvokeControllerStub($this->app))
        ->toBeArray();
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class);

it('will throws `RuntimeException` for `getArguments::object`.', function (): void {
    expect(new ArgumentResolver())
        ->getArguments(Request::createFromGlobals(), function (int $id): void {
        })
        ->toBeArray();
})->group(__DIR__, __FILE__)->throws(\RuntimeException::class);

it('will throws `RuntimeException` for `getArguments::array`.', function (): void {
    expect(new ArgumentResolver())
        ->getArguments(Request::createFromGlobals(), [
            $this->app->make(ExampleControllerStub::class),
            'exampleMethod',
        ])
        ->toBeArray();
})->group(__DIR__, __FILE__)->throws(\RuntimeException::class);

it('will return array for `getArguments`.', function (): void {
    expect(new ArgumentResolver())
        ->getArguments(Request::createFromGlobals(), new ExampleInvokeControllerStub($this->app))
        ->toBeArray();
})->group(__DIR__, __FILE__);

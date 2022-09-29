<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Facades;

use Coole\Console\Application;
use Coole\Console\Facades\Console;
use Coole\Database\Facades\DB;
use Coole\ErrorHandler\Facades\ErrorHandler;
use Coole\Foundation\App;
use Coole\Foundation\Facades\App as AppFacade;
use Coole\Foundation\Facades\Facade;
use Coole\Logger\Facades\Logger;
use Mockery\ExpectationInterface;
use Mockery\ExpectsHigherOrderMessage;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will not return for `resolved`.', function (): void {
    \app(LoggerInterface::class);
    expect(Logger::resolved(fn (LoggerInterface $logger) => $logger))->toBeNull();
    \app(LoggerInterface::class);
})->group(__DIR__, __FILE__);

it('will return `LegacyMockInterface|null` for `spy`.', function (): void {
    expect(Logger::spy())
        ->toBeInstanceOf(LoggerInterface::class)
        ->toBeInstanceOf(LegacyMockInterface::class);

    expect(Logger::spy())->toBeNull();
})->group(__DIR__, __FILE__);

it('will return `MockInterface` for `partialMock`.', function (): void {
    expect(Logger::partialMock())
        ->toBeInstanceOf(LoggerInterface::class)
        ->toBeInstanceOf(MockInterface::class);

    expect(Console::partialMock())
        ->toBeInstanceOf(Application::class)
        ->toBeInstanceOf(MockInterface::class);
})->group(__DIR__, __FILE__);

it('will return `ExpectationInterface` for `shouldReceive`.', function (): void {
    expect(Logger::shouldReceive('error'))
        ->toBeInstanceOf(ExpectationInterface::class);

    expect(DB::shouldReceive('select'))
        ->toBeInstanceOf(ExpectationInterface::class);
})->group(__DIR__, __FILE__);

it('will return `ExpectsHigherOrderMessage` for `expects`.', function (): void {
    expect(Logger::expects())
        ->toBeInstanceOf(ExpectsHigherOrderMessage::class);

    expect(ErrorHandler::expects())
        ->toBeInstanceOf(ExpectsHigherOrderMessage::class);
})->group(__DIR__, __FILE__);

it('will return null for `getMockableClass`.', function (): void {
    expect(
        (new class() extends Facade {
            protected static ?App $app = null;

            protected static function getFacadeAccessor(): string
            {
                return 'foo';
            }
        })::partialMock()
    )->toBeInstanceOf(MockInterface::class);
})->group(__DIR__, __FILE__);

it('will throws `RuntimeException` for `getFacadeAccessor`.', function (): void {
    Facade::foo();
})->group(__DIR__, __FILE__)->throws(RuntimeException::class);

it('will return `Instance` for `resolveFacadeInstance`.', function (): void {
    expect(
        (new class() extends Logger {
            protected static bool $cached = false;

            protected static function getFacadeAccessor(): string
            {
                return 'logger';
            }
        })::getFacadeRoot()
    )->toBeInstanceOf(LoggerInterface::class);
})->group(__DIR__, __FILE__);

it('will return null for `clearResolvedInstance`.', function (): void {
    expect(Facade::clearResolvedInstance('foo'))->toBeNull();
})->group(__DIR__, __FILE__);

it('will return null for `clearResolvedInstances`.', function (): void {
    expect(Facade::clearResolvedInstances())->toBeNull();
})->group(__DIR__, __FILE__);

it('will return `App` for `getFacadeApplication`.', function (): void {
    expect(Facade::getFacadeApplication())->toBeInstanceOf(App::class);
})->group(__DIR__, __FILE__);

it('will return null for `__callStatic`.', function (): void {
    expect(AppFacade::getMiddleware())->toBeArray();
})->group(__DIR__, __FILE__);

it('will throws RuntimeException for `__callStatic`.', function (): void {
    (new class() extends Facade {
        protected static ?App $app = null;

        protected static function getFacadeAccessor(): string
        {
            return 'logger';
        }
    })::foo();
})->group(__DIR__, __FILE__)->throws(RuntimeException::class, 'A facade root has not been set.');

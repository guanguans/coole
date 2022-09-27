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

use Coole\ErrorHandler\ReportableHandler;
use Exception;
use Throwable;

it('will return bool for `__invoke`.', function (): void {
    expect(
        new ReportableHandler(static function (Throwable $throwable): void {
        })
    )
        ->__invoke(mock(Exception::class)->makePartial())
        ->toBeBool();

    expect(
        new ReportableHandler(static fn (Throwable $throwable) => false)
    )
        ->__invoke(mock(Exception::class)->makePartial())
        ->toBeBool();
})->group(__DIR__, __FILE__);

it('will return bool for `handles`.', function (): void {
    expect(
        new ReportableHandler(static function (Throwable $throwable): void {
        })
    )
        ->handles(mock(Exception::class)->makePartial())
        ->toBeBool();

    expect(
        new ReportableHandler(static function (\stdClass $stdClass): void {
        })
    )
        ->handles(mock(Exception::class)->makePartial())
        ->toBeBool();
})->group(__DIR__, __FILE__);

it('will return self for `stop`.', function (): void {
    expect(
        new ReportableHandler(static function (Throwable $throwable): void {
        })
    )
        ->stop()
        ->toBeInstanceOf(ReportableHandler::class);
})->group(__DIR__, __FILE__);

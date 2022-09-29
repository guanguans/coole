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
use Coole\Foundation\Manager;
use Illuminate\Container\Container;
use InvalidArgumentException;
use stdClass;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
    $this->manager = new class($this->app) extends Manager {
        public function getDefaultDriver(): string
        {
            return 'logger';
        }

        public function createLoggerDriver()
        {
            return app('logger');
        }
    };
});

it('will return stdClass for `createDriver`.', function (): void {
    expect(
        $this->manager->extend('bar', fn () => new stdClass())
    )->driver('bar')->toBeInstanceOf(stdClass::class);
})->group(__DIR__, __FILE__);

it('will throws method of default-driver  for `createDriver`.', function (): void {
    expect($this->manager)->driver('bar');
})->group(__DIR__, __FILE__)->throws(InvalidArgumentException::class);

it('will return array for `getDrivers`.', function (): void {
    expect($this->manager)
        ->getDrivers()->toBeArray();
})->group(__DIR__, __FILE__);

it('will return `Container` for `getContainer`.', function (): void {
    expect($this->manager)
        ->getContainer()->toBeInstanceOf(Container::class);
})->group(__DIR__, __FILE__);

it('will return self for `setContainer`.', function (): void {
    expect($this->manager)
        ->setContainer($this->app)->toBeInstanceOf(Manager::class);
})->group(__DIR__, __FILE__);

it('will return self for `forgetDrivers`.', function (): void {
    expect($this->manager)
        ->forgetDrivers()->toBeInstanceOf(Manager::class);
})->group(__DIR__, __FILE__);

it('will call method of default-driver  for `__call`.', function (): void {
    expect($this->manager)
        ->error('foo')->toBeNull();
})->group(__DIR__, __FILE__);

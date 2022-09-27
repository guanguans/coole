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

use Coole\Console\Application;
use Coole\Foundation\App;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\NullOutput;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will report `Option Exception` for `run`.', function (): void {
    $application = new Application($this->app);
    $application->setAutoExit(false);

    expect($application->run())
        ->toBeInt();
})->group(__DIR__, __FILE__);

it('will report `LogicException` for `run`.', function (): void {
    /** @var App $app */
    $app = clone $this->app;
    $app->commands(new class() extends Command {});
    $application = new Application($app);
    $application->setAutoExit(false);

    expect($application->run())
        ->toBeInt();
})->group(__DIR__, __FILE__);

it('will return string for `getHelp`.', function (): void {
    $application = new Application(new App());
    $application->setAutoExit(false);

    expect($application)
        ->getHelp()
        ->toBeString();
})->group(__DIR__, __FILE__);

it('will not return for `reportException`.', function (): void {
    $application = new Application(new App());
    $application->setAutoExit(false);

    expect(invade($application))
        ->reportException(new Exception())
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `renderException`.', function (): void {
    $application = new Application(new App());
    $application->setAutoExit(false);

    expect(invade($application))
        ->renderException(new NullOutput(), new Exception())
        ->toBeNull();
})->group(__DIR__, __FILE__);

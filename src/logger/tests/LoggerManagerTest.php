<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Logger\Tests;

use Coole\Foundation\App;
use Coole\Logger\LoggerManager;
use Monolog\Formatter\FluentdFormatter;
use Monolog\Logger;

use function Pest\Faker\faker;

use Psr\Log\NullLogger;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will return `Monolog` for `createStackDriver`.', function (): void {
    $this->app['config']['logger.channels.stack.ignore_exceptions'] = true;
    $this->app['config']['logger.channels.stack.channels'] = 'single';
    expect($loggerManager = new LoggerManager($this->app))
        ->channel('stack')->toBeInstanceOf(Logger::class);

    $this->app['config']['logger.channels.stack.channels'] = [$loggerManager->channel('single')];
    expect(new LoggerManager($this->app))
        ->channel('stack')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createDailyDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->channel('daily')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createSlackDriver`.', function (): void {
    $this->app['config']['logger.channels.slack.url'] = faker()->url();
    expect(new LoggerManager($this->app))
        ->channel('slack')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createSyslogDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->channel('syslog')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createErrorlogDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->channel('errorlog')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createPapertrailDriver`.', function (): void {
    $this->app['config']['logger.channels.papertrail.handler_with.host'] = faker()->url;
    $this->app['config']['logger.channels.papertrail.handler_with.port'] = faker()->numberBetween();
    expect(new LoggerManager($this->app))
        ->channel('papertrail')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createStderrDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->channel('stderr')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createNullDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->channel('null')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will return `Monolog` for `createMonologDriver`.', function (): void {
    $this->app['config']['logger.channels.null.handler'] = 'foo';
    expect(new LoggerManager($this->app))
        ->channel('null')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class);

it('will return `HandlerInterface` for `prepareHandler`.', function (): void {
    $this->app['config']['logger.channels.single.action_level'] = 'warning';
    $this->app['config']['logger.channels.single.formatter'] = FluentdFormatter::class;
    expect(new LoggerManager($this->app))
        ->channel('single')->toBeInstanceOf(Logger::class);
})->group(__DIR__, __FILE__);

it('will throws `InvalidArgumentException` for `createDriver`.', function (): void {
    $this->app['config']['logger.channels.foo'] = [];
    expect(new LoggerManager($this->app))->channel('foo');
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class, 'Driver [foo] not supported.');

it('will throws `InvalidArgumentException` for `configurationFor`.', function (): void {
    expect(new LoggerManager($this->app))->channel('foo');
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class, 'Logger [foo] is not defined.');

it('will return `NullLogger` by callCustomCreator for `createDriver`.', function (): void {
    $loggerManager = new LoggerManager($this->app);
    $loggerManager->extend('null', fn () => new NullLogger());
    expect($loggerManager)
        ->channel('null')->toBeInstanceOf(NullLogger::class);
})->group(__DIR__, __FILE__);

it('will not return for `setDefaultDriver`.', function (): void {
    expect(new LoggerManager($this->app))
        ->setDefaultDriver('single')->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `forgetChannel`.', function (): void {
    $loggerManager = new LoggerManager($this->app);
    $loggerManager->channel('single');

    expect($loggerManager)
        ->forgetChannel('single')->toBeNull();
})->group(__DIR__, __FILE__);

it('will return array for `getChannels`.', function (): void {
    expect(new LoggerManager($this->app))
        ->getChannels()
        ->toBeArray();
})->group(__DIR__, __FILE__);

it('will log different levels logs.', function (): void {
    expect(new LoggerManager($this->app))
        ->emergency($message = faker()->title())
        ->toBeNull()
        ->alert($message)
        ->toBeNull()
        ->critical($message)
        ->toBeNull()
        ->error($message)
        ->toBeNull()
        ->warning($message)
        ->toBeNull()
        ->notice($message)
        ->toBeNull()
        ->info($message)
        ->toBeNull()
        ->debug($message);
})->group(__DIR__, __FILE__);

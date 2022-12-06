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

use Coole\EventDispatcher\Tests\stubs\ExampleEventStub;
use Coole\EventDispatcher\Tests\stubs\ExampleInvokeListenerStub;
use Coole\EventDispatcher\Tests\stubs\ExampleListenerStub;
use Coole\Foundation\App;
use Coole\Foundation\Config;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will return mixed for `app`.', function (): void {
    expect(\app())->toBeInstanceOf(App::class)
        ->and(\app(LoggerInterface::class))->toBeInstanceOf(LoggerInterface::class);
})->group(__DIR__, __FILE__);

it('will return `Config` and set config for `config`.', function (): void {
    expect(\config())->toBeInstanceOf(Config::class)
        ->and(\config(['foo.bar' => 'bar']))->toBeNull();
})->group(__DIR__, __FILE__);

it('will return env value for `cenv`.', function (): void {
    $this->app->loadEnvFrom(__DIR__.'/fixtures');
    expect(\cenv())->toBeArray()
        ->and(\cenv('TRUE'))->toBeTrue()
        ->and(\cenv('FALSE'))->toBeFalse()
        ->and(\cenv('EMPTY'))->toBeEmpty()->toBeString()
        ->and(\cenv('NULL'))->toBeNull()
        ->and(\cenv('FOO'))->toBe('foo');
})->group(__DIR__, __FILE__);

it('will throws `RuntimeException` for `event`.', function (): void {
    event(new ExampleEventStub(), \stdClass::class);
})->group(__DIR__, __FILE__)->throws(\RuntimeException::class, 'The stdClass is not a callback type.');

it('will return object value for `event`.', function (): void {
    expect(
        event(
            new ExampleEventStub(),
            [
                function (ExampleEventStub $exampleEventStub): void {
                },
                ExampleInvokeListenerStub::class,
                new class() implements EventSubscriberInterface {
                    public static function getSubscribedEvents()
                    {
                        return [];
                    }
                },
                ExampleListenerStub::class,
                [new ExampleListenerStub(), 'handle'],
            ],
        )
    )->toBeInstanceOf(ExampleEventStub::class);

    expect(event(
        new ExampleEventStub(),
        function (ExampleEventStub $exampleEventStub): void {}
    ))->toBeInstanceOf(ExampleEventStub::class);

    expect(event(
        new ExampleEventStub(),
        ExampleInvokeListenerStub::class
    ))->toBeInstanceOf(ExampleEventStub::class);

    expect(event(
        new ExampleEventStub(),
        new class() implements EventSubscriberInterface {
            public static function getSubscribedEvents()
            {
                return [];
            }
        }
    ))->toBeInstanceOf(ExampleEventStub::class);

    expect(event(
        new ExampleEventStub(),
        ExampleListenerStub::class
    ))->toBeInstanceOf(ExampleEventStub::class);

    expect(event(
        new ExampleEventStub(),
        [new ExampleListenerStub(), 'handle']
    ))->toBeInstanceOf(ExampleEventStub::class);
})->group(__DIR__, __FILE__);

it('can call callback for `call`.', function (): void {
    expect(
        call('Coole\EventDispatcher\Tests\stubs\ExampleListenerStub@handle', [
            'exampleEventStub' => 'event',
        ])
    )->toBeNull();
})->group(__DIR__, __FILE__);

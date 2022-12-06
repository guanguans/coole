<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher\Tests;

use Coole\EventDispatcher\EventDispatcher;
use Coole\EventDispatcher\ListenCollection;
use Coole\EventDispatcher\Tests\stubs\ExampleEventStub;
use Coole\EventDispatcher\Tests\stubs\ExampleInvokeListenerStub;
use Coole\EventDispatcher\Tests\stubs\ExampleListenerStub;
use Coole\Foundation\App;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will throws `RuntimeException` for `dispatch`.', function (): void {
    $this->app[ListenCollection::class] = $this->app[ListenCollection::class]->mergeRecursive([
        ExampleEventStub::class => [
            \stdClass::class,
        ],
    ]);

    expect(new EventDispatcher($this->app))
        ->dispatch(new ExampleEventStub())
        ->toBeInstanceOf(ExampleEventStub::class);
})->group(__DIR__, __FILE__)->throws(\RuntimeException::class);

it('will return object for `dispatch`.', function (): void {
    $this->app[ListenCollection::class] = $this->app[ListenCollection::class]->mergeRecursive([
        ExampleEventStub::class => [
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
        ],
    ]);

    expect(new EventDispatcher($this->app))
        ->dispatch(new ExampleEventStub())
        ->toBeInstanceOf(ExampleEventStub::class);
})->group(__DIR__, __FILE__);

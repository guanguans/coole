<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Tests\Commands;

use Coole\Console\Commands\ServeCommand;
use Coole\Foundation\App;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will return null for `initialize`.', function (): void {
    $input = mock(InputInterface::class)
        ->shouldReceive('getOption')
        ->andReturn(10)
        ->getMock();

    $output = mock(SymfonyStyle::class)->makePartial();

    $serveCommand = invade(new ServeCommand($this->app));

    expect($serveCommand)
        ->initialize($input, $output)
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will throws `InvalidArgumentException` with `Please set option of docroot.` for `execute`.', function (): void {
    $input = mock(InputInterface::class)
        ->shouldReceive('getOption')
        ->andReturn(null)
        ->getMock();

    $output = mock(SymfonyStyle::class)->makePartial();

    $serveCommand = invade(new ServeCommand($this->app));

    expect($serveCommand)
        ->execute($input, $output);
})->group(__DIR__, __FILE__)->throws(InvalidArgumentException::class, 'Please set option of docroot.');

it('will throws `InvalidArgumentException` with `Docroot directory not exist.` for `execute`.', function (): void {
    $input = mock(InputInterface::class)
        ->shouldReceive('getOption')
        ->andReturn('docroot')
        ->getMock();

    $output = mock(SymfonyStyle::class)->makePartial();

    $serveCommand = invade(new ServeCommand($this->app));

    expect($serveCommand)
        ->execute($input, $output);
})->group(__DIR__, __FILE__)->throws(InvalidArgumentException::class, 'Docroot directory not exist.');

it('will return int for `execute`.', function (): void {
    $m = mock(InputInterface::class);

    $m->shouldReceive('getOption')
        ->andReturn(
            __DIR__,
            '127.0.0.1',
            9000,
            'docroot',
            9000,
            __DIR__,
            '127.0.0.1',
            9001,
            'docroot'
        );

    $input = $m->shouldReceive('setOption')
        ->andReturnNull()
        ->getMock();

    $output = mock(SymfonyStyle::class)
        ->shouldReceive('info')
        ->andReturnNull()
        ->getMock();

    $serveCommand = invade(new ServeCommand($this->app));
    $serveCommand->tries = 1;
    $serveCommand->input = $input;
    $serveCommand->output = $output;

    expect($serveCommand)
        ->execute($input, $output)
        ->toBeInt();
})->group(__DIR__, __FILE__);

it('will return string for `serverCommand`.', function (): void {
    $m = mock(InputInterface::class);

    $input = $m->shouldReceive('getOption')
        ->times(3)
        ->andReturn('host', 'port', 'docroot')
        ->getMock();

    expect(invade(new ServeCommand($this->app)))
        ->serverCommand($input)
        ->toBeString();
})->group(__DIR__, __FILE__);

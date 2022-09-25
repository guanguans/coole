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

use Coole\Console\Command;
use Coole\Foundation\App;
use Symfony\Component\Console\Formatter\NullOutputFormatter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

it('will return int for `run`', function (): void {
    $m = mock(InputInterface::class);

    $m->shouldReceive('getOption')->andReturn(10);
    $m->shouldReceive('bind')->andReturnNull();
    $m->shouldReceive('isInteractive')->andReturnTrue();
    $m->shouldReceive('hasArgument')->andReturnTrue();
    $m->shouldReceive('getArgument')->andReturn('make:command');
    $input = $m->shouldReceive('validate')
        ->andReturnTrue()
        ->getMock();

    $m = mock(OutputInterface::class);

    $m->shouldReceive('getVerbosity')->andReturn(1);
    $output = $m->shouldReceive('getFormatter')
        ->andReturnUsing(fn () => new NullOutputFormatter())
        ->getMock();

    $app = mock(App::class)->makePartial();

    $command = invade(
        new class($app) extends Command {
            protected string $name = 'name';
            protected string $description = 'The description.';
            protected array $arguments = [
                ['argument', InputArgument::OPTIONAL, 'The description.', 'argument'],
            ];
            protected array $options = [
                ['option', null, InputOption::VALUE_OPTIONAL, 'The description.', 'option'],
            ];

            protected function execute(InputInterface $input, OutputInterface $output): int
            {
                return 0;
            }
        }
    );

    expect($command)
        ->run($input, $output)
        ->toBeInt();
})->group(__DIR__, __FILE__);

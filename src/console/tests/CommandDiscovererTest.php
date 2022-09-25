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

use Coole\Console\CommandDiscoverer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Console\Command\Command;

it('will throws `BindingResolutionException` for `getCommands`', function (): void {
    expect(new CommandDiscoverer(__DIR__.'/../src/', __NAMESPACE__))
        ->getCommands();
})->group(__DIR__, __FILE__)->throws(BindingResolutionException::class);

it('will return array for `getCommands`', function (): void {
    expect(new CommandDiscoverer(__DIR__.'/../src/Commands', '\\Coole\\Console\\Commands'))
        ->getCommands()
        ->toBeArray()
        ->each
        ->toBeInstanceOf(Command::class)

    ;
})->group(__DIR__, __FILE__);

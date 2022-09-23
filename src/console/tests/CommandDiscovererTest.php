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

it('will throws `BindingResolutionException` when calling `getCommands`', function (): void {
    expect(new CommandDiscoverer(__DIR__, __NAMESPACE__))
        ->getCommands();
})->group(__DIR__, __FILE__)->throws(BindingResolutionException::class);

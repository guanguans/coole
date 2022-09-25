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

use Coole\Console\CommandCollection;
use Coole\Console\ConsoleServiceProvider;
use Coole\Foundation\App;
use Coole\Foundation\Config;

it('will not return for `boot`', function (): void {
    $m = mock(App::class);
    $m->shouldReceive('commands')->andReturnNull();
    $m->shouldReceive('offsetGet')->with('console.command_collection')->andReturn(new CommandCollection());
    $m->shouldReceive('offsetGet')->with('config')->andReturn(
        new Config([
            'console' => [
                'commands' => [
                    [
                        'dir' => __DIR__,
                        'namespace' => __NAMESPACE__,
                    ],
                ],
            ],
        ])
    );
    $app = $m->shouldReceive('loadCommandFrom')->andReturnNull()->getMock();

    expect(new ConsoleServiceProvider($app))
        ->boot()
        ->toBeNull();
});

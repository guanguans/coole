<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Tightenco\Collect\Support\Collection as Command;

class CommandServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Command::class, function ($app) {
            return new Command();
        });
        $app->alias(Command::class, 'command');
    }
}

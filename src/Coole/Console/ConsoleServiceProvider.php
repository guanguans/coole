<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console;

use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Application::class, function ($app) {
            return new Application($app);
        });
        $app->alias(Application::class, 'console');
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Tightenco\Collect\Support\Collection as Command;

class ConsoleServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface, AfterRegisterAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'console' => [
                'command' => [
                    [
                        'dir' => __DIR__.'/../Console/Commands',
                        'namespace' => '\Guanguans\Coole\Console\Commands',
                        'suffix' => '*Command.php',
                    ],
                ],
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Application::class, function ($app) {
            return new Application($app);
        });
        $app->alias(Application::class, 'console');

        $app->singleton('command', function ($app) {
            return new Command();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        $app->loadCommand(__DIR__.'/../Console/Commands', '\Guanguans\Coole\Console\Commands');

        foreach ($app['config']['console']['command'] as $command) {
            $app->loadCommand($command['dir'], $command['namespace'], $command['suffix']);
        }
    }
}

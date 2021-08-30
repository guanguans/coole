<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console;

use Coole\Foundation\Able\AfterRegisterAbleProviderInterface;
use Coole\Foundation\Able\BeforeRegisterAbleProviderInterface;
use Coole\Foundation\App;
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
                        'dir' => __DIR__.'/Commands',
                        'namespace' => '\Coole\Console\Commands',
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
        $app->loadCommand(__DIR__.'/Commands', '\Coole\Console\Commands');

        foreach ($app['config']['console']['command'] as $command) {
            $app->loadCommand($command['dir'], $command['namespace'], $command['suffix']);
        }
    }
}

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

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Illuminate\Container\Container;
use Illuminate\Support\Collection as Command;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->loadConfig(__DIR__.'/../config', false);
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

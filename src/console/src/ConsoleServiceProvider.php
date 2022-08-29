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

use Coole\Foundation\ServiceProvider;
use Illuminate\Support\Collection as Command;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering()
    {
        $this->app->loadConfig(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(Application::class, function ($app) {
            return new Application($this->app);
        });
        $this->app->alias(Application::class, 'console');

        $this->app->singleton('command', function ($app) {
            return new Command();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function registered()
    {
        $this->app->loadCommand(__DIR__.'/Commands', '\Coole\Console\Commands');

        foreach ($this->app['config']['console']['command'] as $command) {
            $this->app->loadCommand($command['dir'], $command['namespace'], $command['suffix']);
        }
    }
}

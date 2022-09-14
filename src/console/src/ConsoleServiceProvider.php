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

use Coole\Console\Commands\ServeCommand;
use Coole\Foundation\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/console.php');
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(Application::class);
        $this->app->alias(Application::class, 'console');

        $this->app->singleton(CommandCollection::class);
        $this->app->alias(CommandCollection::class, 'console.command.collection');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        $this->app->commands(ServeCommand::class);

        foreach ($this->app['config']['console']['commands'] as $command) {
            $this->app->loadCommandFrom($command['dir'], $command['namespace']);
        }
    }
}

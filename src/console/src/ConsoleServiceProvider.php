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
use Coole\Console\Facades\Console;
use Coole\Foundation\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        Application::class,
        CommandCollection::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        Application::class => ['console'],
        CommandCollection::class => ['console.command_collection'],
    ];

    /**
     * {@inheritdoc}
     */
    protected array $classAliases = [
        Console::class,
    ];

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
    public function boot(): void
    {
        $this->app->commands(ServeCommand::class);

        foreach ($this->app['config']['console.commands'] as $command) {
            $this->app->loadCommandFrom($command['dir'], $command['namespace']);
        }
    }
}

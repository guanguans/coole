<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Logger;

use Coole\Foundation\ServiceProvider;
use Coole\Logger\Facades\Logger;
use Psr\Log\LoggerInterface;

class LoggerServiceProvider extends ServiceProvider
{
    protected array $bindings = [
        LoggerInterface::class => LoggerManager::class,
    ];

    protected array $singletons = [
        LoggerManager::class,
    ];

    protected array $aliases = [
        LoggerManager::class => ['logger', 'logger.manager'],
    ];

    protected array $classAliases = [
        Logger::class,
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/logger.php');
    }
}

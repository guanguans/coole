<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Logger\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static void                            alert(string $message, array $context = [])
 * @method static void                            critical(string $message, array $context = [])
 * @method static void                            debug(string $message, array $context = [])
 * @method static void                            emergency(string $message, array $context = [])
 * @method static void                            error(string $message, array $context = [])
 * @method static void                            info(string $message, array $context = [])
 * @method static void                            log($level, string $message, array $context = [])
 * @method static void                            notice(string $message, array $context = [])
 * @method static void                            warning(string $message, array $context = [])
 * @method static \Psr\Log\LoggerInterface        channel(string $channel = null)
 * @method static \Psr\Log\LoggerInterface        driver(?string $driver = null)
 * @method static \Coole\Logger\LoggerManager     extend(string $driver, \Closure $callback)
 * @method static void                            forgetChannel(?string $driver = null)
 * @method static \Coole\Logger\LoggerManager     forgetDrivers()
 * @method static array                           getChannels()
 * @method static \Illuminate\Container\Container getContainer()
 * @method static string                          getDefaultDriver()
 * @method static array                           getDrivers()
 * @method static \Coole\Logger\LoggerManager     setContainer(\Illuminate\Container\Container $container)
 * @method static void                            setDefaultDriver(string $name)
 *
 * @mixin  \Coole\Logger\LoggerManager
 *
 * @see \Coole\Logger\LoggerManager
 */
class Logger extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'logger';
    }
}

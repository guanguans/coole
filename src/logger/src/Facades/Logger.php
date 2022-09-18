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
 * @method static \Psr\Log\LoggerInterface    channel(string $channel = null)
 * @method static \Coole\Logger\LoggerManager shareContext(array $context)
 * @method static array                       sharedContext()
 * @method static void                        alert(string $message, array $context = [])
 * @method static void                        critical(string $message, array $context = [])
 * @method static void                        debug(string $message, array $context = [])
 * @method static void                        emergency(string $message, array $context = [])
 * @method static void                        error(string $message, array $context = [])
 * @method static void                        info(string $message, array $context = [])
 * @method static void                        log($level, string $message, array $context = [])
 * @method static void                        notice(string $message, array $context = [])
 * @method static void                        warning(string $message, array $context = [])
 *
 * @mixin  \Coole\Logger\LoggerManager
 *
 * @see \Coole\Logger\LoggerManager
 */
class Logger extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'logger';
    }
}

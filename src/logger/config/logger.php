<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [
    /*
     * 默认日志通道
     */
    'default' => cenv('LOGGER_CHANNEL', 'stack'),

    /*
     * 日志通道列表
     */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => base_path('var/logs/app.log'),
            'level' => cenv('LOGGER_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => base_path('var/logs/app.log'),
            'level' => cenv('LOGGER_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => cenv('LOGGER_SLACK_WEBHOOK_URL'),
            'username' => 'Coole Log',
            'emoji' => ':boom:',
            'level' => cenv('LOGGER_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => cenv('LOGGER_LEVEL', 'debug'),
            'handler' => cenv('LOGGER_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => cenv('PAPERTRAIL_URL'),
                'port' => cenv('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.cenv('PAPERTRAIL_URL').':'.cenv('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => cenv('LOGGER_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => cenv('LOGGER_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => cenv('LOGGER_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => cenv('LOGGER_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],
    ],
];

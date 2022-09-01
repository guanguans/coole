<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return [
    /*
     * 名称
     */
    'name' => 'app',

    /*
     * 默认处理器
     */
    'default_handler' => StreamHandler::class,

    /*
     * 默认格式化器
     */
    'default_formatter' => LineFormatter::class,

    /*
     * 处理器列表
     */
    'handlers' => [
        StreamHandler::class => [
            // 日志文件
            'stream' => cenv('LOGGER_LOG_FILE', base_path('var/logs/app.log')),
            // 级别
            'level' => Logger::DEBUG,
            // 堆栈是否冒泡
            'bubble' => true,
            // 日志文件权限
            'filePermission' => null,
            // 是否锁定日志文件
            'use_locking' => false,
        ],
    ],

    /*
     * 格式化器列表
     */
    'formatters' => [
        LineFormatter::class => [
            // 日志格式
            'format' => null,
            // 时间格式
            'dateFormat' => 'Y-m-d H:i:s',
            // 是否在日志条目中允许行内换行
            'allowInlineLineBreaks' => false,
            // 是否忽略空上下文和额外内容
            'ignoreEmptyContextAndExtra' => false,
            // 是否引入堆栈跟踪
            'includeStacktraces' => false,
        ],
    ],
];

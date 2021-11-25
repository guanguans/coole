<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Monolog\Logger;

return [
    /*
     * 名称
     */
    'name' => 'app',

    /*
     * 级别
     */
    'level' => Logger::DEBUG,

    /*
     * 堆栈是否冒泡
     */
    'bubble' => true,

    /*
     * 日志文件权限
     */
    'file_permission' => null,

    /*
     * 日志文件
     */
    'log_file' => cenv('LOGGER_LOG_FILE', base_path('runtime/logs/app.log')),

    /*
     * 是否锁定日志文件
     */
    'use_locking' => false,

    /*
     * 格式化程序
     */
    'formatter' => [
        // 日志格式
        'format' => null,

        // 时间格式
        'date_format' => 'Y-m-d H:i:s',

        // 是否在日志条目中允许行内换行
        'allow_inline_line_breaks' => false,

        // 是否忽略空上下文和额外内容
        'ignore_empty_context_and_extra' => false,
    ],
];

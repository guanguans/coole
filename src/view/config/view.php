<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

return [
    /*
     * 视图文件目录
     */
    'path' => null,

    /*
     * 选项
     */
    'options' => [
        // Debug
        'debug' => false,

        // 字符集
        'charset' => 'UTF-8',

        // 是否忽略模板中的无效变量
        'strict_variables' => false,

        // 是否启用自动转义
        'autoescape' => 'html',

        // 缓存目录
        'cache' => cenv('VIEW_CACHE_DIRECTORY', base_path('var/views')),

        // 如果模板更改，是否重新加载模板
        'auto_reload' => cenv('APP_DEBUG', null),

        // 优化
        'optimizations' => -1,
    ],
];

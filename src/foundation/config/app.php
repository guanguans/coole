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
     * App 名称
     */
    'name' => cenv('APP_NAME', 'Coole'),

    /*
     * 环境
     */
    'env' => cenv('APP_ENV', 'production'),

    /*
     * Debug
     */
    'debug' => (bool) cenv('APP_DEBUG', false),

    /*
     * 时区
     */
    'timezone' => 'Asia/Shanghai',

    /*
     * 字符集
     */
    'charset' => 'UTF-8',

    /*
     * .env 文件目录
     */
    // 'env_path' => base_path(),
    'env_path' => null,

    /*
     * 配置文件目录
     */
    // 'config_path' => base_path('config'),
    'config_path' => null,

    /*
     * 第三方服务
     */
    'providers' => [
        // \App\Provider\ExampleServiceProvider::class,
    ],

    /*
     * 全局中间件
     */
    'middleware' => [
        // \App\Middleware\ExampleMiddleware::class,
    ],
];

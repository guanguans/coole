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
    'name' => cenv('APP_NAME', 'Coole'),

    'env' => cenv('APP_ENV', 'production'),

    'debug' => cenv('APP_DEBUG', false),

    'timezone' => 'Asia/Shanghai',

    'env_path' => base_path(),

    'config_path' => base_path('config'),

    'providers' => [
        // \App\Provider\ExampleServiceProvider::class,
    ],

    /*
     * 全局中间件
     */
    'middleware' => [
        // \App\Middleware\ExampleMiddleware::class,
    ],

    'route' => [
        base_path('route'),
    ],
];

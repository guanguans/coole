<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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

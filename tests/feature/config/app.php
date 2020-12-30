<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    'name' => env('APP_NAME', 'Coole'),

    'env' => env('APP_ENV', 'production'),

    'debug' => env('APP_DEBUG', false),

    'timezone' => 'Asia/Shanghai',

    'providers' => [
        // \App\Provider\LoadCommandServiceProvider::class,
        // \App\Provider\LoadRouteServiceProvider::class,
        // \App\Provider\MiddlewareServiceProvider::class,
    ],

    /*
     * 全局中间件
     */
    'middleware' => [
        // \App\Middleware\ExampleMiddleware::class
    ],
];

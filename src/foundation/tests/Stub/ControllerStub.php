<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Stub;

use Coole\HttpKernel\Controller\Controller;

class ControllerStub extends Controller
{
    protected $middleware = [
        MiddlewareStub::class,
    ];

    protected $excludedMiddleware = [
        MiddlewareStub::class,
    ];

    public function hello()
    {
    }
}

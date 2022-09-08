<?php

declare(strict_types=1);

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
    protected array $middleware = [
        MiddlewareStub::class,
    ];

    protected array $excludedMiddleware = [
        MiddlewareStub::class,
    ];

    public function hello()
    {
    }
}

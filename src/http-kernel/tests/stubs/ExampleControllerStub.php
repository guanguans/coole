<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Tests\stubs;

use Coole\Foundation\App;
use Coole\HttpKernel\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExampleControllerStub extends Controller
{
    public function __construct(protected App $app)
    {
    }

    public function exampleMethod(Request $request, int $id): void
    {
    }
}

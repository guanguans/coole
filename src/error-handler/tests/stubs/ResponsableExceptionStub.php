<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Tests\stubs;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ResponsableExceptionStub extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return new Response();
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coole\Foundation\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;

interface MiddlewareInterface
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next);
}

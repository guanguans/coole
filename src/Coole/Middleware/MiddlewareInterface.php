<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, Closure $next);
}

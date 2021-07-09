<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckResponseForModifications implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof Response) {
            $response->isNotModified($request);
        }

        return $response;
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Middlewares;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckResponseForModifications implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if ($response instanceof Response) {
            $response->isNotModified($request);
        }

        return $response;
    }
}

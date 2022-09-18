<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Routing\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static \Coole\Routing\Route          any(string $pattern, mixed $action)
 * @method static \Coole\Routing\Route          delete(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          get(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          match(string|array $methods, string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          options(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          patch(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          post(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\Route          put(string $pattern, mixed $action = null)
 * @method static \Coole\Routing\RouteRegistrar middleware(mixed $middleware)
 * @method static \Coole\Routing\RouteRegistrar prefix(string $prefix)
 * @method static \Coole\Routing\RouteRegistrar group(array $attributes, callable $callback)
 *
 * @mixin \Coole\Routing\Router
 *
 * @see \Coole\Routing\Router
 */
class Router extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'router';
    }
}

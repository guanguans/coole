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

use Coole\Foundation\Facade;

/**
 * @method static \Coole\Routing\Route          any(string|string[] $methods, string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          delete(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          get(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          match(string|string[] $methods, string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          options(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          patch(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          post(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          put(string $pattern, array|string|callable|null $to = null)
 * @method static \Coole\Routing\Route          setPath(string $pattern)
 * @method static \Coole\Routing\Route          setHost(?string $pattern)
 * @method static \Coole\Routing\Route          setSchemes(string|string[] $schemes)
 * @method static \Coole\Routing\Route          setMethods(string|string[] $methods)
 * @method static \Coole\Routing\Route          setOptions(array $options)
 * @method static \Coole\Routing\Route          setOption(string $name, $value)
 * @method static \Coole\Routing\Route          setDefaults(array $defaults)
 * @method static \Coole\Routing\Route          setDefault(string $name, $default)
 * @method static \Coole\Routing\Route          setRequirements(array $requirements)
 * @method static \Coole\Routing\Route          setRequirement(string $key, string $regex)
 * @method static \Coole\Routing\Route          setCondition(?string $condition)
 * @method static \Coole\Routing\RouteRegistrar prefix(string  $prefix)
 * @method static \Coole\Routing\RouteRegistrar group(array $attributes, callable $routes)
 *
 * @see \Coole\Routing\Router
 */
class Router extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}

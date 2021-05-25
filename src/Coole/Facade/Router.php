<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Facade;

/**
 * @method static \Guanguans\Coole\Routing\Route any(string|string[] $methods, string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route delete(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route get(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route match(string|string[] $methods, string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route options(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route patch(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route post(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route put(string $pattern, array|string|callable|null $to = null)
 * @method static \Guanguans\Coole\Routing\Route setPath(string $pattern)
 * @method static \Guanguans\Coole\Routing\Route setHost(?string $pattern)
 * @method static \Guanguans\Coole\Routing\Route setSchemes(string|string[] $schemes)
 * @method static \Guanguans\Coole\Routing\Route setMethods(string|string[] $methods)
 * @method static \Guanguans\Coole\Routing\Route setOptions(array $options)
 * @method static \Guanguans\Coole\Routing\Route setOption(string $name, $value)
 * @method static \Guanguans\Coole\Routing\Route setDefaults(array $defaults)
 * @method static \Guanguans\Coole\Routing\Route setDefault(string $name, $default)
 * @method static \Guanguans\Coole\Routing\Route setRequirements(array $requirements)
 * @method static \Guanguans\Coole\Routing\Route setRequirement(string $key, string $regex)
 * @method static \Guanguans\Coole\Routing\Route setCondition(?string $condition)
 * @method static \Guanguans\Coole\Routing\RouteRegistrar prefix(string  $prefix)
 * @method static \Guanguans\Coole\Routing\RouteRegistrar group(array $attributes, callable $routes)
 *
 * @see \Guanguans\Coole\Routing\Router
 */
class Router extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return \Guanguans\Coole\Routing\Router::class;
    }
}

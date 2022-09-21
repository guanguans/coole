<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Facades;

use Closure;
use Coole\Foundation\App;
use Mockery;
use Mockery\Expectation;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use RuntimeException;

/**
 * This is modified from https://github.com/laravel/framework.
 */
abstract class Facade
{
    /**
     * The application instance being facaded.
     */
    protected static ?App $app;

    /**
     * The resolved object instances.
     */
    protected static array $resolvedInstance = [];

    /**
     * Indicates if the resolved instance should be cached.
     */
    protected static bool $cached = true;

    /**
     * Run a Closure when the facade has been resolved.
     */
    public static function resolved(Closure $callback): void
    {
        $accessor = static::getFacadeAccessor();

        if (true === static::$app->resolved($accessor)) {
            $callback(static::getFacadeRoot());
        }

        static::$app->afterResolving($accessor, static function ($service) use ($callback): void {
            $callback($service);
        });
    }

    /**
     * Convert the facade into a Mockery spy.
     */
    public static function spy(): LegacyMockInterface|MockInterface|null
    {
        if (! static::isMock()) {
            $class = static::getMockableClass();

            $spy = $class ? Mockery::spy($class) : Mockery::spy();
            static::swap($spy);

            return $spy;
        }

        return null;
    }

    /**
     * Initiate a partial mock on the facade.
     */
    public static function partialMock(): MockInterface
    {
        $name = static::getFacadeAccessor();

        $mock = static::isMock()
            ? static::$resolvedInstance[$name]
            : static::createFreshMockInstance();

        return $mock->makePartial();
    }

    /**
     * Initiate a mock expectation on the facade.
     */
    public static function shouldReceive(): Expectation
    {
        $name = static::getFacadeAccessor();

        $mock = static::isMock()
            ? static::$resolvedInstance[$name]
            : static::createFreshMockInstance();

        return $mock->shouldReceive(...func_get_args());
    }

    /**
     * Initiate a mock expectation on the facade.
     */
    public static function expects(): Expectation
    {
        $name = static::getFacadeAccessor();

        $mock = static::isMock()
            ? static::$resolvedInstance[$name]
            : static::createFreshMockInstance();

        return $mock->expects(...func_get_args());
    }

    /**
     * Create a fresh mock instance for the given class.
     */
    protected static function createFreshMockInstance(): MockInterface
    {
        return tap(static::createMock(), static function ($mock): void {
            static::swap($mock);
            $mock->shouldAllowMockingProtectedMethods();
        });
    }

    /**
     * Create a fresh mock instance for the given class.
     */
    protected static function createMock(): LegacyMockInterface
    {
        $class = static::getMockableClass();

        return $class ? Mockery::mock($class) : Mockery::mock();
    }

    /**
     * Determines whether a mock is set as the instance of the facade.
     */
    protected static function isMock(): bool
    {
        $name = static::getFacadeAccessor();

        return isset(static::$resolvedInstance[$name]) &&
               static::$resolvedInstance[$name] instanceof LegacyMockInterface;
    }

    /**
     * Get the mockable class for the bound instance.
     */
    protected static function getMockableClass(): ?string
    {
        if ($root = static::getFacadeRoot()) {
            return $root::class;
        }

        return null;
    }

    /**
     * Hotswap the underlying instance behind the facade.
     */
    public static function swap(mixed $instance): void
    {
        static::$resolvedInstance[static::getFacadeAccessor()] = $instance;

        if (static::$app) {
            static::$app->instance(static::getFacadeAccessor(), $instance);
        }
    }

    /**
     * Get the root object behind the facade.
     */
    public static function getFacadeRoot(): mixed
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Get the registered name of the component.
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    /**
     * Resolve the facade root instance from the container.
     */
    protected static function resolveFacadeInstance(string $name)
    {
        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        if (static::$app) {
            if (static::$cached) {
                return static::$resolvedInstance[$name] = static::$app[$name];
            }

            return static::$app[$name];
        }
    }

    /**
     * Clear a resolved facade instance.
     */
    public static function clearResolvedInstance(string $name): void
    {
        unset(static::$resolvedInstance[$name]);
    }

    /**
     * Clear all of the resolved instances.
     */
    public static function clearResolvedInstances(): void
    {
        static::$resolvedInstance = [];
    }

    /**
     * Get the application instance behind the facade.
     */
    public static function getFacadeApplication(): ?App
    {
        return static::$app;
    }

    /**
     * Set the application instance.
     */
    public static function setFacadeApplication(App $app): void
    {
        static::$app = $app;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $args): mixed
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}

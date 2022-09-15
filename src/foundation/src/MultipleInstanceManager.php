<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation;

use Closure;
use InvalidArgumentException;
use RuntimeException;

/**
 * This is modified from https://github.com/laravel/framework.
 */
abstract class MultipleInstanceManager
{
    /**
     * The array of resolved instances.
     *
     * @var array<string, mixed>
     */
    protected array $instances = [];

    /**
     * The registered custom instance creators.
     *
     * @var array<string, mixed>
     */
    protected array $customCreators = [];

    /**
     * Create a new manager instance.
     */
    public function __construct(protected App $app)
    {
    }

    /**
     * Get the default instance name.
     */
    abstract public function getDefaultInstance(): string;

    /**
     * Set the default instance name.
     */
    abstract public function setDefaultInstance(string $name): void;

    /**
     * Get the instance specific configuration.
     *
     * @return mixed[]
     */
    abstract public function getInstanceConfig(string $name): array;

    /**
     * Get an instance instance by name.
     */
    public function instance(?string $name = null): mixed
    {
        $name = $name ?: $this->getDefaultInstance();

        return $this->instances[$name] = $this->get($name);
    }

    /**
     * Attempt to get an instance from the local cache.
     */
    protected function get(string $name): mixed
    {
        return $this->instances[$name] ?? $this->resolve($name);
    }

    /**
     * Resolve the given instance.
     *
     * @throws \InvalidArgumentException
     */
    protected function resolve(string $name): mixed
    {
        $config = $this->getInstanceConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException(sprintf('Instance [%s] is not defined.', $name));
        }

        if (! array_key_exists('driver', $config)) {
            throw new RuntimeException(sprintf('Instance [%s] does not specify a driver.', $name));
        }

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($config);
        }

        $driverMethod = 'create'.ucfirst($config['driver']).'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new InvalidArgumentException(sprintf('Instance driver [%s] is not supported.', $config['driver']));
    }

    /**
     * Call a custom instance creator.
     */
    protected function callCustomCreator(array $config): mixed
    {
        return $this->customCreators[$config['driver']]($this->app, $config);
    }

    /**
     * Unset the given instances.
     *
     * @param array<string>|string|null $name
     *
     * @return $this
     */
    public function forgetInstance(null|string|array $name = null): static
    {
        $name ??= $this->getDefaultInstance();

        foreach ((array) $name as $instanceName) {
            if (isset($this->instances[$instanceName])) {
                unset($this->instances[$instanceName]);
            }
        }

        return $this;
    }

    /**
     * Disconnect the given instance and remove from local cache.
     */
    public function purge(?string $name = null): void
    {
        $name ??= $this->getDefaultInstance();

        unset($this->instances[$name]);
    }

    /**
     * Register a custom instance creator Closure.
     *
     * @return $this
     */
    public function extend(string $name, Closure $callback): static
    {
        $this->customCreators[$name] = $callback->bindTo($this, $this);

        return $this;
    }

    /**
     * Dynamically call the default instance.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->instance()->$method(...$parameters);
    }
}

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

abstract class ServiceProvider
{
    /**
     * @var array<string, string>
     */
    protected array $bindings = [];

    /**
     * @var array<string>
     */
    protected array $singletons = [];

    /**
     * @var array<string, string|array<string>>
     */
    protected array $aliases = [];

    /**
     * @var array<string>|array<string, string|array<string>>
     */
    protected array $classAliases = [];

    public function __construct(protected App $app)
    {
    }

    /**
     * 注册服务之前.
     */
    public function registering(): void
    {
    }

    /**
     * 注册服务.
     */
    public function register(): void
    {
    }

    /**
     * 注册服务之后.
     */
    public function registered(): void
    {
    }

    /**
     * 引导应用程序之前.
     */
    public function booting(): void
    {
    }

    /**
     * 引导应用程序.
     */
    public function boot(): void
    {
    }

    /**
     * 引导应用程序之后.
     */
    public function booted(): void
    {
    }

    /**
     * @return array<string, string>
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }

    /**
     * @return array<string>
     */
    public function getSingletons(): array
    {
        return $this->singletons;
    }

    /**
     * @return array<string, string|array<string>>
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @return array<string, string|array<string>>
     */
    public function getClassAliases(): array
    {
        return $this->classAliases;
    }
}

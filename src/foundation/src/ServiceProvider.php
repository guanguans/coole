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
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     * 在给定的容器上注册服务。此方法仅应用于配置服务和参数。它不应获得服务。
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
}

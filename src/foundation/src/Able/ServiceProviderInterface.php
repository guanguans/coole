<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Able;

use Illuminate\Container\Container;

interface ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     * 在给定的容器上注册服务。此方法仅应用于配置服务和参数。它不应获得服务。
     *
     * @param \Illuminate\Container\Container $container A container instance
     *
     * @return mixed|void
     */
    public function register(Container $container);
}

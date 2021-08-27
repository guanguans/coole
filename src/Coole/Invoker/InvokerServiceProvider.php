<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Invoker;

use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Invoker\Invoker;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;

class InvokerServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Invoker::class, function ($app) {
            return new Invoker(new TypeHintContainerResolver($app), $app);
        });

        $app->alias(Invoker::class, 'invoker');
    }
}

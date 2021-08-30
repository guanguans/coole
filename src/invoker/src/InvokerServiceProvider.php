<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Invoker;

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

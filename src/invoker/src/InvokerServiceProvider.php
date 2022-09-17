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

use Coole\Foundation\App;
use Coole\Foundation\ServiceProvider;
use Invoker\Invoker;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;

class InvokerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(
            Invoker::class,
            static fn (App $app): Invoker => new Invoker(new TypeHintContainerResolver($app), $app)
        );

        $this->app->alias(Invoker::class, 'invoker');
    }
}

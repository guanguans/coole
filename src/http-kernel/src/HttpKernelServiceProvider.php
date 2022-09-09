<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel;

use Coole\Foundation\ServiceProvider;
use Coole\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\HttpKernel;

class HttpKernelServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(RequestStack::class);
        $this->app->alias(RequestStack::class, 'http.kernel.request.stack');

        $this->app->instance(ControllerResolver::class, new ControllerResolver($this->app->make('logger')));
        $this->app->alias(ControllerResolver::class, 'http.kernel.controller.resolver');

        $this->app->singleton(ArgumentResolver::class);
        $this->app->alias(ArgumentResolver::class, 'http.kernel.argument.resolver');

        $this->app->instance(HttpKernel::class, new HttpKernel(
            $this->app['event.dispatcher'],
            $this->app['http.kernel.controller.resolver'],
            $this->app['http.kernel.request.stack'],
            $this->app['http.kernel.argument.resolver']
        ));
        $this->app->alias(HttpKernel::class, 'http.kernel');
    }
}

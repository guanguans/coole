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
        $this->app->singleton(RequestStack::class, function ($app) {
            return new RequestStack();
        });
        $this->app->alias(RequestStack::class, 'request_stack');

        $this->app->singleton(ControllerResolver::class, function ($app) {
            return new ControllerResolver(app('logger'));
        });
        $this->app->alias(ControllerResolver::class, 'controller_resolver');

        $this->app->singleton(ArgumentResolver::class, function ($app) {
            return new ArgumentResolver();
        });
        $this->app->alias(ArgumentResolver::class, 'argument_resolver');

        $this->app->singleton(HttpKernel::class, function ($app) {
            return new HttpKernel($app['event.dispatcher'], $app['controller_resolver'], $app['request_stack'], $app['argument_resolver']);
        });
        $this->app->alias(HttpKernel::class, 'http_kernel');
    }
}

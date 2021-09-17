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

use Coole\HttpKernel\Controller\ControllerResolver;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\HttpKernel;

class HttpKernelServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(RequestStack::class, function ($app) {
            return new RequestStack();
        });
        $app->alias(RequestStack::class, 'request_stack');

        $app->singleton(ControllerResolver::class, function ($app) {
            return new ControllerResolver(app('log'));
        });
        $app->alias(ControllerResolver::class, 'controller_resolver');

        $app->singleton(ArgumentResolver::class, function ($app) {
            return new ArgumentResolver();
        });
        $app->alias(ArgumentResolver::class, 'argument_resolver');

        $app->singleton(HttpKernel::class, function ($app) {
            return new HttpKernel($app['event_dispatcher'], $app['controller_resolver'], $app['request_stack'], $app['argument_resolver']);
        });
        $app->alias(HttpKernel::class, 'http_kernel');
    }
}

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

use Coole\Event\EventDispatcher;
use Coole\Foundation\ServiceProvider;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class HttpKernelServiceProvider extends ServiceProvider
{
    protected array $bindings = [
        ControllerResolverInterface::class => ControllerResolver::class,
        ArgumentResolverInterface::class => ArgumentResolver::class,
        EventDispatcherInterface::class => EventDispatcher::class,
    ];

    protected array $singletons = [
        RequestStack::class,
        HttpKernel::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->alias(RequestStack::class, 'http_kernel.request_stack');
        $this->app->alias(HttpKernel::class, 'http_kernel');
    }
}

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

use Coole\EventDispatcher\EventDispatcher;
use Coole\Foundation\ServiceProvider;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class HttpKernelServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected array $bindings = [
        ControllerResolverInterface::class => ControllerResolver::class,
        ArgumentResolverInterface::class => ArgumentResolver::class,
        EventDispatcherInterface::class => EventDispatcher::class,
        HttpKernelInterface::class => HttpKernel::class,
        TerminableInterface::class => HttpKernel::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        RequestStack::class,
        HttpKernel::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        RequestStack::class => ['http_kernel.request_stack'],
        HttpKernel::class => ['http_kernel'],
    ];
}

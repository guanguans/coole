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
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;

class HttpKernelServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected array $bindings = [
        ArgumentResolverInterface::class => ArgumentResolver::class,
        ControllerResolverInterface::class => ControllerResolver::class,
        HttpKernelInterface::class => HttpKernel::class,
        TerminableInterface::class => HttpKernel::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        ArgumentResolver::class,
        ControllerResolver::class,
        RequestStack::class,
        HttpKernel::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        ArgumentResolver::class => ['http_kernel.argument_resolver'],
        ControllerResolver::class => ['http_kernel.controller_resolver'],
        RequestStack::class => ['http_kernel.request_stack'],
        HttpKernel::class => ['http_kernel'],
    ];
}

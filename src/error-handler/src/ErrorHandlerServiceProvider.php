<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler;

use Coole\ErrorHandler\Whoops\WhoopsExceptionRenderer;
use Coole\Foundation\ServiceProvider;

class ErrorHandlerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected array $bindings = [
        ErrorHandlerInterface::class => ErrorHandler::class,
        ExceptionRendererInterface::class => WhoopsExceptionRenderer::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $singletons = [
        ErrorHandler::class,
        WhoopsExceptionRenderer::class,
    ];

    /**
     * {@inheritdoc}
     */
    protected array $aliases = [
        ErrorHandlerInterface::class => ['error_handler'],
        ExceptionRendererInterface::class => ['error_handler.exception_renderer'],
    ];

    /**
     * {@inheritdoc}
     */
    protected array $classAliases = [
        \Coole\ErrorHandler\Facades\ErrorHandler::class,
    ];
}

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
use Symfony\Component\ErrorHandler\ErrorHandler as SymfonyErrorHandler;

class ErrorHandlerServiceProvider extends ServiceProvider
{
    protected array $bindings = [
        ErrorHandlerInterface::class => ErrorHandler::class,
        ExceptionRendererInterface::class => WhoopsExceptionRenderer::class,
    ];

    protected array $singletons = [
        ErrorHandler::class,
        WhoopsExceptionRenderer::class,
    ];

    protected array $aliases = [
        ErrorHandler::class => ['error-handler'],
        WhoopsExceptionRenderer::class => ['error-handler.exception-renderer'],
    ];

    protected array $classAliases = [
        \Coole\ErrorHandler\Facades\ErrorHandler::class,
    ];

    public function registered(): void
    {
        SymfonyErrorHandler::register();

        if ($this->app['config']['app.debug']) {
            $this->app[WhoopsExceptionRenderer::class]
                ->whoops(true)
                ->register();
        }
    }
}

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
    public function register(): void
    {
        $this->app->bind(ErrorHandlerInterface::class, ErrorHandler::class);
        $this->app->bind(ExceptionRendererInterface::class, WhoopsExceptionRenderer::class);
    }
}

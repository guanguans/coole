<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Whoops;

use Coole\ErrorHandler\ExceptionRendererInterface;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

class WhoopsExceptionRenderer implements ExceptionRendererInterface
{
    /**
     * Renders the given exception as HTML.
     *
     * @param \Throwable $throwable
     */
    public function render($throwable): string
    {
        return tap(new Whoops(), function ($whoops): void {
            $whoops->appendHandler($this->whoopsHandler());

            $whoops->writeToOutput(false);

            $whoops->allowQuit(false);
        })->handleException($throwable);
    }

    /**
     * Get the Whoops handler for the application.
     */
    protected function whoopsHandler(): PrettyPageHandler
    {
        return (new WhoopsHandler())->forDebug();
    }
}

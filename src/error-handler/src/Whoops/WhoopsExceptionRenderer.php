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
use Whoops\Run as Whoops;

class WhoopsExceptionRenderer implements ExceptionRendererInterface
{
    /**
     * Renders the given exception as HTML.
     *
     * @param \Throwable $throwable
     *
     * @return string
     */
    public function render($throwable)
    {
        return tap(new Whoops(), function ($whoops) {
            $whoops->appendHandler($this->whoopsHandler());

            $whoops->writeToOutput(false);

            $whoops->allowQuit(false);
        })->handleException($throwable);
    }

    /**
     * Get the Whoops handler for the application.
     *
     * @return \Whoops\Handler\Handler
     */
    protected function whoopsHandler()
    {
        return (new WhoopsHandler())->forDebug();
    }
}

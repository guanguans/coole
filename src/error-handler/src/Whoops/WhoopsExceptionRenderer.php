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
use Throwable;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

/**
 * This is modified from https://github.com/laravel/framework.
 */
class WhoopsExceptionRenderer implements ExceptionRendererInterface
{
    /**
     * Renders the given exception as HTML.
     */
    public function render(Throwable $throwable): string
    {
        return $this->whoops()->handleException($throwable);
    }

    /**
     * Get the Whoops for the application.
     */
    public function whoops(bool $isOutputed = false): Whoops
    {
        $run = new Whoops();

        $run->appendHandler($this->whoopsHandler());
        $run->writeToOutput($isOutputed);
        $run->allowQuit(false);

        return $run;
    }

    /**
     * Get the Whoops handler for the application.
     */
    protected function whoopsHandler(): PrettyPageHandler
    {
        return (new WhoopsHandler())->forDebug();
    }
}

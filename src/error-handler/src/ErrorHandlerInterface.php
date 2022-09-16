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

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

interface ErrorHandlerInterface
{
    /**
     * Report or log an exception.
     *
     * @throws \Throwable
     */
    public function report(Throwable $throwable): void;

    /**
     * Determine if the exception should be reported.
     */
    public function shouldReport(Throwable $throwable): bool;

    /**
     * Render an exception into an HTTP response.
     *
     * @throws \Throwable
     */
    public function render(Request $request, Throwable $throwable): Response;

    /**
     * Render an exception to the console.
     *
     * @internal this method is not meant to be used or overwritten outside the framework
     */
    public function renderForConsole(OutputInterface $output, Throwable $throwable): void;
}

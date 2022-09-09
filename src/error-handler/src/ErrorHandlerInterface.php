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
use Throwable;

interface ErrorHandlerInterface
{
    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $throwable);

    /**
     * Determine if the exception should be reported.
     *
     * @return bool
     */
    public function shouldReport(Throwable $throwable);

    /**
     * Render an exception into an HTTP response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render(Request $request, Throwable $throwable);

    /**
     * Render an exception to the console.
     *
     * @return void
     *
     * @internal this method is not meant to be used or overwritten outside the framework
     */
    public function renderForConsole(OutputInterface $output, Throwable $throwable);
}

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

interface ExceptionRendererInterface
{
    /**
     * Renders the given exception as HTML.
     *
     * @param \Throwable $throwable
     *
     * @return string
     */
    public function render($throwable);
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Controller;

interface ControllerInterface
{
    /**
     * 渲染模板
     *
     * @param $name
     */
    public function render($name, array $context = []): string;
}

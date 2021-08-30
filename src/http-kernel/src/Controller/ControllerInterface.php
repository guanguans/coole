<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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

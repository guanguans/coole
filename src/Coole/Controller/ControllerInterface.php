<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Controller;

interface ControllerInterface
{
    /**
     * Renders a template.
     *
     * @param $name
     *
     * @return string
     */
    public function render($name, array $context = []);
}

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

class ControllerResolver extends \Symfony\Component\HttpKernel\Controller\ControllerResolver
{
    /**
     * {@inheritDoc}
     */
    protected function instantiateController(string $class): ControllerInterface
    {
        return app($class);
    }
}

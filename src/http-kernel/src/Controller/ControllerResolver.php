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

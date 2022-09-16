<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel;

use Symfony\Component\HttpKernel\Controller\ControllerResolver as SymfonyControllerResolver;

class ControllerResolver extends SymfonyControllerResolver
{
    /**
     * @param ControllerInterface::class $class
     */
    protected function instantiateController(string $class): ControllerInterface
    {
        return app($class);
    }
}

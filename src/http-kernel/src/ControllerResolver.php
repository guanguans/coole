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
     * {@inheritdoc}
     */
    protected function createController(string $controller): callable
    {
        $controller = str_replace('@', '::', $controller);

        return parent::createController($controller);
    }

    /**
     * @param class-string<\Coole\HttpKernel\Controller>|string $class
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function instantiateController(string $class): Controller
    {
        return app($class);
    }
}

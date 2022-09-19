<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\ArgumentResolver;

use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Throwable;

final class ServiceValueResolver implements ArgumentValueResolverInterface
{
    /**
     * @var mixed 被解析的参数值
     */
    private mixed $resolvedArgumentValue;

    public function __construct(private Container $container)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $classes = explode('|', $argument->getType());

        foreach ($classes as $class) {
            try {
                $this->resolvedArgumentValue = $this->container->make($class);

                return true;
            } catch (Throwable) {
                continue;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        yield $this->resolvedArgumentValue;
    }
}

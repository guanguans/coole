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

use Coole\HttpKernel\ArgumentResolver\ServiceValueResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactoryInterface;

/**
 * Responsible for resolving the arguments passed to an action.
 *
 * This is modified from https://github.com/symfony/symfony.
 */
final class ArgumentResolver implements ArgumentResolverInterface
{
    private ArgumentMetadataFactoryInterface $argumentMetadataFactory;

    private iterable $argumentValueResolvers;

    /**
     * @param iterable<mixed, ArgumentValueResolverInterface> $argumentValueResolvers
     */
    public function __construct(?ArgumentMetadataFactoryInterface $argumentMetadataFactory = null, iterable $argumentValueResolvers = [])
    {
        $this->argumentMetadataFactory = $argumentMetadataFactory ?? new ArgumentMetadataFactory();
        $this->argumentValueResolvers = $argumentValueResolvers ?: self::getDefaultArgumentValueResolvers();
    }

    public function getArguments(Request $request, callable $controller): array
    {
        $arguments = [];

        /** @var string|object|array|callable $controller */
        foreach ($this->argumentMetadataFactory->createArgumentMetadata($controller) as $argumentMetadatum) {
            foreach ($this->argumentValueResolvers as $argumentValueResolver) {
                if (! $argumentValueResolver->supports($request, $argumentMetadatum)) {
                    continue;
                }

                $resolved = $argumentValueResolver->resolve($request, $argumentMetadatum);

                $atLeastOne = false;
                foreach ($resolved as $append) {
                    $atLeastOne = true;
                    $arguments[] = $append;
                }

                if (! $atLeastOne) {
                    throw new \InvalidArgumentException(sprintf('"%s::resolve()" must yield at least one value.', get_debug_type($argumentValueResolver)));
                }

                // continue to the next controller argument
                continue 2;
            }

            $representative = $controller;

            if (\is_array($representative)) {
                $representative = sprintf('%s::%s()', $representative[0]::class, $representative[1]);
            } elseif (\is_object($representative)) {
                $representative = $representative::class;
            }

            throw new \RuntimeException(sprintf('Controller "%s" requires that you provide a value for the "$%s" argument. Either the argument is nullable and no null value has been provided, no default value has been provided or because there is a non optional argument after this one.', $representative, $argumentMetadatum->getName()));
        }

        return $arguments;
    }

    /**
     * @return iterable<int, ArgumentValueResolverInterface>
     */
    public static function getDefaultArgumentValueResolvers(): iterable
    {
        return [
            new RequestAttributeValueResolver(),
            new RequestValueResolver(),
            new SessionValueResolver(),
            new DefaultValueResolver(),
            new VariadicValueResolver(),
            new ServiceValueResolver(app()),
        ];
    }
}

<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Facade;

/**
 * @method static \Twig\Environment render($name, array $context = [])
 * @method static \Twig\Environment display($name, array $context = [])
 *
 * @see \Twig\Environment
 */
class View extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return 'view';
    }
}

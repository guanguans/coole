<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\View\Facade;

use Coole\Foundation\Facades\Facade;

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

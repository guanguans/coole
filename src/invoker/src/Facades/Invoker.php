<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Invoker\Facades;

use Coole\Foundation\Facade;

/**
 * @method static mixed call($callable, array $parameters = [])
 *
 * @see \Invoker\Invoker
 */
class Invoker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'invoker';
    }
}

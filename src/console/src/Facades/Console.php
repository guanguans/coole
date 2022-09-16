<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @mixin  \Coole\Console\Application
 *
 * @see \Coole\Console\Application
 */
class Console extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'console';
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static void                                       report(\Throwable $throwable)
 * @method static bool                                       shouldReport(\Throwable $throwable)
 * @method static \Symfony\Component\HttpFoundation\Response render(\Symfony\Component\HttpFoundation\Request $request, \Throwable $throwable)
 * @method static void                                       renderForConsole(\Symfony\Component\Console\Output\OutputInterface $output, \Throwable $throwable)
 *
 * @mixin  \Coole\ErrorHandler\ErrorHandler
 *
 * @see \Coole\ErrorHandler\ErrorHandler
 */
class ErrorHandler extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'error-handler';
    }
}

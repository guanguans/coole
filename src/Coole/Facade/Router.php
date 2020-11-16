<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Facade;

class Router extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Guanguans\Coole\Routing\Router::class;
    }
}

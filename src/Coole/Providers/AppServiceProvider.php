<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class AppServiceProvider implements ServiceProviderInterface, BootAbleProviderInterface
{
    public function boot(App $app)
    {
        $app['debug'] = false;
        $app['charset'] = 'UTF-8';
        $app['logger'] = null;
    }

    public function register(Container $app)
    {
    }
}

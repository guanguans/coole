<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Coole\Console\LoadCommandAble;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Tightenco\Collect\Support\Collection as Command;

class CommandServiceProvider implements ServiceProviderInterface, AfterRegisterAbleProviderInterface
{
    use LoadCommandAble;

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton('command', function ($app) {
            return new Command();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        $this->loadCommand(__DIR__.'/../Console/Commands', '\Guanguans\Coole\Console\Commands');
    }
}

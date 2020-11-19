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
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;
use Tightenco\Collect\Support\Collection as Config;

class ConfigServiceProvider implements ServiceProviderInterface, AfterRegisterAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton('config', function ($app) {
            return new Config();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        if ($dir = config_path()) {
            $files = Finder::create()->files()->in($dir)->name('*.php');

            $config = [];
            foreach ($files as $file) {
                $config[$file->getBasename('.php')] = require $file->getPathname();
            }

            $app->mergeConfig($config);
        }
    }
}

<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Dotenv\Dotenv;
use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\Finder\Finder;
use Tightenco\Collect\Support\Collection as Config;

class ConfigServiceProvider implements ServiceProviderInterface, AfterRegisterAbleProviderInterface, BeforeRegisterAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        if (null !== base_path()) {
            $dotenv = Dotenv::createUnsafeMutable(base_path());
            $dotenv->load();
        }
    }

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

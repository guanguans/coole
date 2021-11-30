<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Config;

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Illuminate\Container\Container;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        is_null($app['env_path']) or $app->loadEnv($app['env_path']);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(Config::class, function ($app) {
            return new Config();
        });
        $app->alias(Config::class, 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        is_null($app['config_path']) or $app->loadConfig($app['config_path']);
    }
}

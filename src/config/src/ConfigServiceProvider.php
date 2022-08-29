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

use Coole\Foundation\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering()
    {
        is_null($this->app['env_path']) or $this->app->loadEnv($this->app['env_path']);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(Config::class, function ($app) {
            return new Config();
        });
        $this->app->alias(Config::class, 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function registered()
    {
        is_null($this->app['config_path']) or $this->app->loadConfig($this->app['config_path']);
    }
}

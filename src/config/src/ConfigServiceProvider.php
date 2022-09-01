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
    public function registering(): void
    {
        is_null($this->app['env_path']) or $this->app->loadEnvsFrom($this->app['env_path']);
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->instance(Config::class, new Config());
        $this->app->alias(Config::class, 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        is_null($this->app['config_path']) or $this->app->loadConfigsFrom($this->app['config_path']);
    }
}

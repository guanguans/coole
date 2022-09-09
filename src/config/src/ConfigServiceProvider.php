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
    public function register(): void
    {
        $this->app->singletonIf(Config::class, new Config());
        $this->app->alias(Config::class, 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        // is_null($envPath = $this->app['config']['app']['env_path']) or $this->app->loadEnvsFrom($envPath);
        // is_null($configPath = $this->app['config']['app']['config_path']) or $this->app->loadConfigsFrom($configPath);
    }
}

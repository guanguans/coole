<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\View;

use Coole\Foundation\ServiceProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering()
    {
        $this->app->loadConfigsFrom(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(FilesystemLoader::class, function ($app) {
            $loader = new FilesystemLoader();

            foreach ((array) $app['config']['view']['path'] as $namespace => $path) {
                is_string($namespace) ? $loader->setPaths($path, $namespace) : $loader->addPath($path);
            }

            return $loader;
        });
        $this->app->alias(FilesystemLoader::class, 'twig_filesystem_loader');

        $this->app->singleton(Environment::class, function ($app) {
            return new Environment($app['twig_filesystem_loader'], $app['config']['view']['options']);
        });
        $this->app->alias(Environment::class, 'view');
    }
}

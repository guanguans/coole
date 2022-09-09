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

use Coole\Foundation\App;
use Coole\Foundation\ServiceProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering(): void
    {
        $this->app->loadConfigsFrom(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(FilesystemLoader::class, static function (App $app) {
            $filesystemLoader = new FilesystemLoader();
            foreach ((array) $app['config']['view']['path'] as $namespace => $path) {
                is_string($namespace) ? $filesystemLoader->setPaths($path, $namespace) : $filesystemLoader->addPath($path);
            }

            return $filesystemLoader;
        });
        $this->app->alias(FilesystemLoader::class, 'view.loader');

        $this->app->singleton(
            Environment::class,
            static fn (App $app) => new Environment($app['view.loader'], $app['config']['view']['options'])
        );
        $this->app->alias(Environment::class, 'view');
    }
}

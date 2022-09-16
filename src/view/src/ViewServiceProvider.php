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
        $this->app->loadConfigFrom(__DIR__.'/../config/view.php');
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(FilesystemLoader::class, static function (App $app): FilesystemLoader {
            $filesystemLoader = new FilesystemLoader();
            foreach ((array) $app['config']['view.paths'] as $namespace => $path) {
                is_string($namespace) ? $filesystemLoader->setPaths($path, $namespace) : $filesystemLoader->addPath($path);
            }

            return $filesystemLoader;
        });
        $this->app->alias(FilesystemLoader::class, 'view.loader');

        $this->app->singleton(
            Environment::class,
            static fn (App $app): Environment => new Environment($app['view.loader'], $app['config']['view.options'])
        );
        $this->app->alias(Environment::class, 'view');
    }
}

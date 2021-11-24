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

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Illuminate\Container\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->loadConfig(__DIR__.'/../config/view.php', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(FilesystemLoader::class, function ($app) {
            $loader = new FilesystemLoader();

            foreach ((array) $app['config']['view']['path'] as $namespace => $path) {
                is_string($namespace) ? $loader->setPaths($path, $namespace) : $loader->addPath($path);
            }

            return $loader;
        });
        $app->alias(FilesystemLoader::class, 'twig_filesystem_loader');

        $app->singleton(Environment::class, function ($app) {
            return new Environment($app['twig_filesystem_loader'], $app['config']['view']['options']);
        });
        $app->alias(Environment::class, 'view');
    }
}

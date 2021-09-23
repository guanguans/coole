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
use Guanguans\Di\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * @var \Twig\Loader\LoaderInterface
     */
    public $loader;

    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'view' => require __DIR__.'/../config/view.php',
        ]);

        $loader = new FilesystemLoader();

        $paths = (array) $app['config']['view']['path'];
        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }

        $this->loader = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton(FilesystemLoader::class, function ($app) {
            return $this->loader;
        });
        $app->alias(FilesystemLoader::class, 'twig_filesystem_loader');

        $app->singleton(Environment::class, function ($app) {
            return new Environment($app['twig_filesystem_loader'], $app['config']['view']['options']);
        });
        $app->alias(Environment::class, 'view');
    }
}

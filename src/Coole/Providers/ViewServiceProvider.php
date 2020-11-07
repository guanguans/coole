<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider implements ServiceProviderInterface, BootAbleProviderInterface
{
    public $loader;

    public function boot(App $app)
    {
        $loader = new FilesystemLoader();

        $paths = is_array($app['config']['view']['path']) ? $app['config']['view']['path'] : [$app['config']['view']['path']];

        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }

        $this->loader = $loader;
    }

    public function register(Container $app)
    {
        $app->singleton(FilesystemLoader::class, function ($app) {
            return $this->loader;
        });
        $app->alias(FilesystemLoader::class, 'twig_filesystem_loader');

        $app->singleton(Environment::class, function ($app) {
            return new Environment($app['twig_filesystem_loader'], isset($app['config']['view']['options']) ? $app['config']['view']['options'] : []);
        });
        $app->alias(Environment::class, 'view');
    }
}

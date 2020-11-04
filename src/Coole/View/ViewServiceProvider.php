<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\View;

use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider implements ServiceProviderInterface, BootAbleProviderInterface
{
    public $loader;

    public $options;

    /**
     * ViewServiceProvider constructor.
     * @param $path
     * @param  array  $options
     * @throws \Twig\Error\LoaderError
     */
    public function __construct($path, array $options = [])
    {
        $loader = new FilesystemLoader();

        $paths = is_array($path) ? $path : [$path];

        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }

        $this->loader = $loader;
        $this->options = $options;
    }

    public function boot(App $app)
    {
    }

    public function register(Container $app)
    {
        $app->singleton(FilesystemLoader::class, function ($app) {
            return $this->loader;
        });
        $app->alias(FilesystemLoader::class, 'twig_filesystem_loader');

        $app->singleton(Environment::class, function ($app) {
            return new Environment($app['twig_filesystem_loader'], $this->options);
        });
        $app->alias(Environment::class, 'view');
    }
}

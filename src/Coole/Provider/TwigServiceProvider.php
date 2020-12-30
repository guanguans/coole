<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Provider;

use Guanguans\Coole\Able\BeforeRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigServiceProvider implements ServiceProviderInterface, BeforeRegisterAbleProviderInterface
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
            'view' => [
                'path' => null,
                'options' => [
                    'debug' => false,
                    'charset' => 'UTF-8',
                    'strict_variables' => false,
                    'autoescape' => 'html',
                    'cache' => base_path('runtime/views'),
                    'auto_reload' => null,
                    'optimizations' => -1,
                ],
            ],
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
            return new Environment($app['twig_filesystem_loader'], $app['config']['view']['options'] ?? []);
        });
        $app->alias(Environment::class, 'view');
    }
}

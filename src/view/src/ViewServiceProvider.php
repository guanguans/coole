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
use Coole\View\Facades\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

class ViewServiceProvider extends ServiceProvider
{
    protected array $aliases = [
        Environment::class => ['view'],
    ];

    protected array $classAliases = [
        View::class,
    ];

    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/view.php');
    }

    public function register(): void
    {
        $this->app->bind(LoaderInterface::class, static function (App $app): FilesystemLoader {
            $filesystemLoader = new FilesystemLoader();
            foreach ((array) $app['config']['view.paths'] as $namespace => $path) {
                is_string($namespace) ? $filesystemLoader->setPaths($path, $namespace) : $filesystemLoader->addPath($path);
            }

            return $filesystemLoader;
        });

        $this->app->singleton(
            Environment::class,
            fn (App $app): Environment => new Environment(
                $app[LoaderInterface::class],
                $app['config']['view.options']
            ),
        );
    }
}

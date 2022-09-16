<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Whoops;

use Illuminate\Support\Arr;
use Symfony\Component\Finder\Finder;
use Whoops\Handler\PrettyPageHandler;

/**
 * This is modified from https://github.com/laravel/framework.
 */
class WhoopsHandler
{
    /**
     * Create a new Whoops handler for debug mode.
     */
    public function forDebug(): PrettyPageHandler
    {
        return tap(new PrettyPageHandler(), function ($handler): void {
            $handler->handleUnconditionally(true);

            $this->registerApplicationPaths($handler)
                ->registerBlacklist($handler)
                ->registerEditor($handler);
        });
    }

    /**
     * Register the application paths with the handler.
     *
     * @return $this
     */
    protected function registerApplicationPaths(PrettyPageHandler $prettyPageHandler): static
    {
        $prettyPageHandler->setApplicationPaths(
            array_flip($this->directoriesExceptVendor())
        );

        return $this;
    }

    /**
     * Get the application paths except for the "vendor" directory.
     *
     * @return array<string>
     */
    protected function directoriesExceptVendor(): array
    {
        return Arr::except(
            array_flip($this->directories(base_path())),
            [base_path('vendor')]
        );
    }

    /**
     * Get all of the directories within a given directory.
     *
     * @return array<string>
     */
    public function directories(string $directory): array
    {
        $directories = [];

        foreach (Finder::create()->in($directory)->directories()->depth(0)->sortByName() as $finder) {
            $directories[] = $finder->getPathname();
        }

        return $directories;
    }

    /**
     * Register the blacklist with the handler.
     *
     * @return $this
     */
    protected function registerBlacklist(PrettyPageHandler $prettyPageHandler): static
    {
        foreach (config('app.debug_blacklist', config('app.debug_hide', [])) as $key => $secrets) {
            foreach ($secrets as $secret) {
                $prettyPageHandler->blacklist($key, $secret);
            }
        }

        return $this;
    }

    /**
     * Register the editor with the handler.
     *
     * @return $this
     */
    protected function registerEditor(PrettyPageHandler $prettyPageHandler): static
    {
        if (config('app.editor', false)) {
            $prettyPageHandler->setEditor(config('app.editor'));
        }

        return $this;
    }
}

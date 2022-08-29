<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler;

use Coole\Foundation\ServiceProvider;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandlerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton('whoops_error_page_handler', function ($app) {
            if (PHP_SAPI === 'cli') {
                return new PlainTextHandler();
            }

            return new PrettyPageHandler();
        });

        $this->app->singleton(Run::class, function ($app) {
            $run = new Run();
            $run->allowQuit(false);
            $run->pushHandler($this->app['whoops_error_page_handler']);

            return $run;
        });
        $this->app->alias(Run::class, 'whoops');
    }

    /**
     * {@inheritdoc}
     */
    public function registered(): void
    {
        $this->boot();
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        ErrorHandler::register();

        $this->app['debug'] and $this->app['whoops']->register();
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Logger;

use Coole\Foundation\Listeners\LogListener;
use Coole\Foundation\ServiceProvider;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\GroupHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering()
    {
        $this->app->loadConfig(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('monolog', function ($app) {
            $log = new Logger($app['config']['logger']['name']);
            $handler = new GroupHandler($app['monolog.handlers']);
            $log->pushHandler($handler);

            return $log;
        });
        $this->app->alias('monolog', 'logger');

        $this->app->singleton(LineFormatter::class, function ($app) {
            return new LineFormatter(
                $app['config']['logger']['formatter']['format'],
                $app['config']['logger']['formatter']['date_format'],
                $app['config']['logger']['formatter']['allow_inline_line_breaks'],
                $app['config']['logger']['formatter']['ignore_empty_context_and_extra']
            );
        });

        $this->app->alias(LineFormatter::class, 'monolog.formatter');

        $this->app->singleton(StreamHandler::class, function ($app) {
            $handler = new StreamHandler(
                $app['config']['logger']['log_file'],
                $app['config']['logger']['level'],
                $app['config']['logger']['bubble'],
                $app['config']['logger']['file_permission'],
                $app['config']['logger']['use_locking']
            );
            $handler->setFormatter($app['monolog.formatter']);

            return $handler;
        });
        $this->app->alias(StreamHandler::class, 'monolog.handler');

        $this->app->singleton('monolog.handlers', function ($app) {
            $handlers = [];
            if ($app['config']['logger']['log_file']) {
                $handlers[] = $app['monolog.handler'];
            }

            return $handlers;
        });

        $this->app->singleton(LogListener::class, function ($app) {
            return new LogListener($app['logger']);
        });
        $this->app->alias(LogListener::class, 'monolog.listener');
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if ($this->app->has('monolog.listener')) {
            $this->app['event_dispatcher']->addSubscriber($this->app['monolog.listener']);
        }

        if ($this->app['debug']) {
            ErrorHandler::register($this->app['monolog']);
        }
    }
}

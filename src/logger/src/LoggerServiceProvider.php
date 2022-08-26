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

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Coole\Foundation\Listeners\LogListener;
use Illuminate\Container\Container;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\GroupHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->loadConfig(__DIR__.'/../config', false);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton('monolog', function ($app) {
            $log = new Logger($app['config']['logger']['name']);
            $handler = new GroupHandler($app['monolog.handlers']);
            $log->pushHandler($handler);

            return $log;
        });
        $app->alias('monolog', 'logger');

        $app->singleton(LineFormatter::class, function ($app) {
            return new LineFormatter(
                $app['config']['logger']['formatter']['format'],
                $app['config']['logger']['formatter']['date_format'],
                $app['config']['logger']['formatter']['allow_inline_line_breaks'],
                $app['config']['logger']['formatter']['ignore_empty_context_and_extra']
            );
        });

        $app->alias(LineFormatter::class, 'monolog.formatter');

        $app->singleton(StreamHandler::class, function ($app) {
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
        $app->alias(StreamHandler::class, 'monolog.handler');

        $app->singleton('monolog.handlers', function ($app) {
            $handlers = [];
            if ($app['config']['logger']['log_file']) {
                $handlers[] = $app['monolog.handler'];
            }

            return $handlers;
        });

        $app->singleton(LogListener::class, function ($app) {
            return new LogListener($app['logger']);
        });
        $app->alias(LogListener::class, 'monolog.listener');
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher)
    {
        if ($app->has('monolog.listener')) {
            $dispatcher->addSubscriber($app['monolog.listener']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function boot(App $app)
    {
        if ($app['debug']) {
            ErrorHandler::register($app['monolog']);
        }
    }
}

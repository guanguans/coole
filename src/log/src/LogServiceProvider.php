<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Log;

use Coole\Foundation\Able\ServiceProvider;
use Coole\Foundation\App;
use Coole\Foundation\Listener\LogListener;
use Guanguans\Di\Container;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\GroupHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class LogServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function beforeRegister(App $app)
    {
        $app->addConfig([
            'log' => require __DIR__.'/../config/log.php',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton('monolog', function ($app) {
            $log = new Logger($app['config']['log']['name']);
            $handler = new GroupHandler($app['monolog.handlers']);
            $log->pushHandler($handler);

            return $log;
        });
        $app->alias('monolog', 'log');

        $app->singleton(LineFormatter::class, function ($app) {
            return new LineFormatter(
                $app['config']['log']['formatter']['format'],
                $app['config']['log']['formatter']['date_format'],
                $app['config']['log']['formatter']['allow_inline_Line_Breaks'],
                $app['config']['log']['formatter']['ignore_empty_context_and_extra']
            );
        });

        $app->alias(LineFormatter::class, 'monolog.formatter');

        $app->singleton(StreamHandler::class, function ($app) {
            $handler = new StreamHandler(
                $app['config']['log']['log_file'],
                $app['config']['log']['level'],
                $app['config']['log']['bubble'],
                $app['config']['log']['file_permission'],
                $app['config']['log']['use_locking']
            );
            $handler->setFormatter($app['monolog.formatter']);

            return $handler;
        });
        $app->alias(StreamHandler::class, 'monolog.handler');

        $app->singleton('monolog.handlers', function ($app) {
            $handlers = [];
            if ($app['config']['log']['log_file']) {
                $handlers[] = $app['monolog.handler'];
            }

            return $handlers;
        });

        $app->singleton(LogListener::class, function ($app) {
            return new LogListener($app['log']);
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

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

use Coole\Foundation\App;
use Coole\Foundation\Listeners\LogListener;
use Coole\Foundation\ServiceProvider;
use Monolog\ErrorHandler;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function registering(): void
    {
        $this->app->loadConfigFrom(__DIR__.'/../config/logger.php');
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->bind(FormatterInterface::class, static fn (App $app) => $app->make(
            $app['config']['logger']['default_formatter'],
            $app['config']['logger']['formatters'][$app['config']['logger']['default_formatter']]
        ));
        $this->app->alias(FormatterInterface::class, 'logger.formatter');

        $this->app->bind(HandlerInterface::class, static function (App $app) {
            $handler = $app->make(
                $app['config']['logger']['default_handler'],
                $app['config']['logger']['handlers'][$app['config']['logger']['default_handler']]
            );
            if ($handler instanceof FormattableHandlerInterface) {
                $handler->setFormatter($app['logger.formatter']);
            }

            return $handler;
        });
        $this->app->alias(HandlerInterface::class, 'logger.handler');

        $this->app->bind(LoggerInterface::class, static function (App $app): Logger {
            $logger = new Logger($app['config']['logger']['name']);
            $logger->pushHandler($app['logger.handler']);

            return $logger;
        });
        $this->app->alias(LoggerInterface::class, 'logger');

        $this->app->singleton(LogListener::class);
        $this->app->alias(LogListener::class, 'logger.listener');
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        if ($this->app->has('logger.listener')) {
            $this->app['event.dispatcher']->addSubscriber($this->app['logger.listener']);
        }

        if ($this->app['config']['app']['debug']) {
            ErrorHandler::register($this->app['logger']);
        }
    }
}

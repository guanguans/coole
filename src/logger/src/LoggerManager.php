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

use Coole\Foundation\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\SlackWebhookHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogHandler;
use Monolog\Handler\WhatFailureGroupHandler;
use Monolog\Logger as Monolog;
use Psr\Log\LoggerInterface;
use Stringable;

class LoggerManager extends Manager implements LoggerInterface
{
    use ParsesLogConfiguration;

    /**
     * The standard date format to use when writing logs.
     */
    protected string $dateFormat = 'Y-m-d H:i:s';

    /**
     * Get a log channel instance.
     */
    public function channel(?string $channel = null): LoggerInterface
    {
        return $this->driver($channel);
    }

    /**
     * Create an aggregate log driver instance.
     */
    protected function createStackDriver(array $config): Monolog
    {
        if (is_string($config['channels'])) {
            $config['channels'] = explode(',', $config['channels']);
        }

        $handlers = collect($config['channels'])->flatMap(fn ($channel) => $channel instanceof LoggerInterface
            ? $channel->getHandlers()
            : $this->channel($channel)->getHandlers())->all();

        $processors = collect($config['channels'])->flatMap(fn ($channel) => $channel instanceof LoggerInterface
            ? $channel->getProcessors()
            : $this->channel($channel)->getProcessors())->all();

        if ($config['ignore_exceptions'] ?? false) {
            $handlers = [new WhatFailureGroupHandler($handlers)];
        }

        return new Monolog($this->parseChannel($config), $handlers, $processors);
    }

    /**
     * Create an instance of the single file log driver.
     */
    protected function createSingleDriver(array $config): Monolog
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(
                new StreamHandler(
                    $config['path'],
                    $this->level($config),
                    $config['bubble'] ?? true, $config['permission'] ?? null, $config['locking'] ?? false
                ),
                $config
            ),
        ]);
    }

    /**
     * Create an instance of the daily file log driver.
     */
    protected function createDailyDriver(array $config): Monolog
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new RotatingFileHandler(
                $config['path'], $config['days'] ?? 7, $this->level($config),
                $config['bubble'] ?? true, $config['permission'] ?? null, $config['locking'] ?? false
            ), $config),
        ]);
    }

    /**
     * Create an instance of the Slack log driver.
     */
    protected function createSlackDriver(array $config): Monolog
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new SlackWebhookHandler(
                $config['url'],
                $config['channel'] ?? null,
                $config['username'] ?? 'Laravel',
                $config['attachment'] ?? true,
                $config['emoji'] ?? ':boom:',
                $config['short'] ?? false,
                $config['context'] ?? true,
                $this->level($config),
                $config['bubble'] ?? true,
                $config['exclude_fields'] ?? []
            ), $config),
        ]);
    }

    /**
     * Create an instance of the syslog log driver.
     */
    protected function createSyslogDriver(array $config): Monolog
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new SyslogHandler(
                Str::snake($this->container['config']['app.name'], '-'),
                $config['facility'] ?? LOG_USER, $this->level($config)
            ), $config),
        ]);
    }

    /**
     * Create an instance of the "error log" log driver.
     */
    protected function createErrorlogDriver(array $config): Monolog
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new ErrorLogHandler(
                $config['type'] ?? ErrorLogHandler::OPERATING_SYSTEM, $this->level($config)
            )),
        ]);
    }

    /**
     * Create an instance of the "error log" log driver.
     */
    protected function createPapertrailDriver(array $config): LoggerInterface
    {
        return $this->createMonologDriver($config);
    }

    /**
     * Create an instance of the "error log" log driver.
     */
    protected function createStderrDriver(array $config): LoggerInterface
    {
        return $this->createMonologDriver($config);
    }

    /**
     * Create an instance of the "error log" log driver.
     */
    protected function createNullDriver(array $config): LoggerInterface
    {
        return $this->createMonologDriver($config);
    }

    /**
     * Create an instance of any handler available in Monolog.
     *
     * @throws \InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createMonologDriver(array $config): Monolog
    {
        if (! is_a($config['handler'], HandlerInterface::class, true)) {
            throw new InvalidArgumentException($config['handler'].' must be an instance of '.HandlerInterface::class);
        }

        $with = array_merge(
            ['level' => $this->level($config)],
            $config['with'] ?? [],
            $config['handler_with'] ?? []
        );

        return new Monolog($this->parseChannel($config), [$this->prepareHandler(
            $this->container->make($config['handler'], $with), $config
        )]);
    }

    /**
     * Prepare the handler for usage by Monolog.
     */
    protected function prepareHandler(HandlerInterface $handler, array $config = []): HandlerInterface
    {
        if (isset($config['action_level'])) {
            $handler = new FingersCrossedHandler($handler, $this->actionLevel($config));
        }

        if (! $handler instanceof FormattableHandlerInterface) {
            return $handler;
        }

        if (! isset($config['formatter'])) {
            $handler->setFormatter($this->formatter());
        } elseif ('default' !== $config['formatter']) {
            $handler->setFormatter($this->container->make($config['formatter'], $config['formatter_with'] ?? []));
        }

        return $handler;
    }

    /**
     * Get a Monolog formatter instance.
     */
    protected function formatter(): FormatterInterface
    {
        return tap(new LineFormatter(null, $this->dateFormat, true, true), static function (LineFormatter $lineFormatter): void {
            $lineFormatter->includeStacktraces();
        });
    }

    /**
     * Get fallback log channel name.
     */
    protected function getFallbackChannelName(): string
    {
        return $this->config->get('app.env', 'production');
    }

    /**
     * {@inheritdoc}
     */
    protected function createDriver(string $driver): mixed
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $config = $this->configurationFor($driver);

        $method = 'create'.Str::studly($driver).'Driver';

        if (method_exists($this, $method)) {
            return $this->$method($config);
        }

        throw new InvalidArgumentException(sprintf('Driver [%s] not supported.', $driver));
    }

    /**
     * Get the log connection configuration.
     *
     * @return array<string, mixed>
     */
    protected function configurationFor(string $name): array
    {
        $config = $this->container['config']["logger.channels.{$name}"];

        if (is_null($config)) {
            throw new InvalidArgumentException("Logger [{$name}] is not defined.");
        }

        return $config;
    }

    /**
     * Get the default log driver name.
     */
    public function getDefaultDriver(): string
    {
        return $this->container['config']['logger.default'];
    }

    /**
     * Set the default log driver name.
     */
    public function setDefaultDriver(string $name): void
    {
        $this->container['config']['logger.default'] = $name;
    }

    /**
     * Unset the given channel instance.
     */
    public function forgetChannel(?string $driver = null): void
    {
        $driver = $this->parseDriver($driver);

        if (isset($this->drivers[$driver])) {
            unset($this->drivers[$driver]);
        }
    }

    /**
     * Parse the driver name.
     */
    protected function parseDriver(?string $driver): string
    {
        $driver ??= $this->getDefaultDriver();

        return $driver;
    }

    /**
     * Get all of the resolved log channels.
     *
     * @return array<string, \Psr\Log\LoggerInterface>
     */
    public function getChannels(): array
    {
        return $this->drivers;
    }

    /**
     * {@inheritdoc}
     */
    public function emergency(Stringable|string $message, array $context = []): void
    {
        $this->driver()->emergency($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function alert(Stringable|string $message, array $context = []): void
    {
        $this->driver()->alert($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function critical(Stringable|string $message, array $context = []): void
    {
        $this->driver()->critical($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function error(Stringable|string $message, array $context = []): void
    {
        $this->driver()->error($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function warning(Stringable|string $message, array $context = []): void
    {
        $this->driver()->warning($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function notice(Stringable|string $message, array $context = []): void
    {
        $this->driver()->notice($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function info(Stringable|string $message, array $context = []): void
    {
        $this->driver()->info($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function debug(Stringable|string $message, array $context = []): void
    {
        $this->driver()->debug($message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        $this->driver()->log($level, $message, $context);
    }
}

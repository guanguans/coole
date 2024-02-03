<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Coole\EventDispatcher\ListenerInterface;
use Coole\Foundation\App;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (! function_exists('app')) {
    /**
     * 获取应用共享实例.
     *
     * @return \Coole\Foundation\App|mixed
     *
     * @throws Illuminate\Contracts\Container\BindingResolutionException
     */
    function app(?string $abstract = null, array $parameters = []): mixed
    {
        if (null === $abstract) {
            return App::getInstance();
        }

        return App::getInstance()->makeWith($abstract, $parameters);
    }
}

if (! function_exists('config')) {
    /**
     * 获取/设置指定的配置值.
     *
     * @return \Coole\Foundation\Config|mixed|null
     */
    function config(string|array|null $key = null, mixed $default = null)
    {
        /** @var Coole\Foundation\Config $config */
        $config = app('config');

        if (null === $key) {
            return $config;
        }

        if (is_array($key)) {
            return $config->set($key);
        }

        return $config->get($key, $default);
    }
}

if (! function_exists('cenv')) {
    /**
     * 获取环境变量的值.
     */
    function cenv(?string $key = null, mixed $default = null): array|bool|string|null
    {
        if (null === $key) {
            return getenv();
        }

        $value = getenv($key);
        if (false === $value) {
            return $default instanceof Closure ? $default() : $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (($valueLength = strlen($value)) > 1 && '"' === $value[0] && '"' === $value[$valueLength - 1]) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('base_path')) {
    /**
     * 获取基本路径.
     */
    function base_path(string $path = ''): string
    {
        if (! defined('BASE_PATH')) {
            throw new RuntimeException('Undefined constant: BASE_PATH.');
        }

        return BASE_PATH.($path ? DIRECTORY_SEPARATOR.$path : '');
    }
}

if (! function_exists('event')) {
    /**
     * 调度事件.
     *
     * @throws Psr\Container\ContainerExceptionInterface
     * @throws Psr\Container\NotFoundExceptionInterface
     */
    function event(
        object $event,
        ListenerInterface|EventSubscriberInterface|callable|array|string|null $listeners = null,
        bool $isDispatched = true
    ): object {
        $listeners = (is_object($listeners) || is_callable($listeners)) ? [$listeners] : (array) $listeners;

        /** @var Symfony\Component\EventDispatcher\EventDispatcher $dispatcher */
        $dispatcher = app('event-dispatcher');

        foreach ($listeners as $listener) {
            if (is_callable($listener)) {
                $dispatcher->addListener($event::class, $listener);

                continue;
            }

            if (is_string($listener)) {
                $listener = app($listener);
            }

            if (is_callable($listener)) {
                $dispatcher->addListener($event::class, $listener);

                continue;
            }

            if ($listener instanceof EventSubscriberInterface) {
                $dispatcher->addSubscriber($listener);

                continue;
            }

            if ($listener instanceof ListenerInterface) {
                $dispatcher->addListener($event::class, [$listener, 'handle']);

                continue;
            }

            /** @var mixed|object|resource $listener */
            throw new RuntimeException(sprintf('The %s is not a callback type.', match (gettype($listener)) {
                'NULL' => 'NUll', 'array' => var_export($listener, true), 'object', 'resource', 'resource (closed)' => $listener::class, default => $listener,
            }));
        }

        $isDispatched and $dispatcher->dispatch($event);

        return $event;
    }
}

if (! function_exists('call')) {
    /**
     * 调用回调.
     *
     * @param array<string, mixed> $parameters
     *
     * @throws InvalidArgumentException
     */
    function call(callable|string $callback, array $parameters = [], ?string $defaultMethod = null): mixed
    {
        return app()->call($callback, $parameters, $defaultMethod);
    }
}

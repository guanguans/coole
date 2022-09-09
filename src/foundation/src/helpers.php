<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Coole\Event\Event;
use Coole\Event\ListenerInterface;
use Coole\Foundation\App;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

if (! function_exists('app')) {
    /**
     * 获取 app 共享实例.
     *
     * @return \Coole\Foundation\App|mixed
     */
    function app(?string $abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return App::getInstance();
        }

        return App::getInstance()->makeWith($abstract, $parameters);
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param array|string|null $key
     *
     * @return mixed|\Illuminate\Config\Repository
     */
    function config($key = null, mixed $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            return app('config')->set($key);
        }

        return app('config')->get($key, $default);
    }
}

if (! function_exists('cenv')) {
    /**
     * 获取环境变量的值
     *
     * @param null $default
     *
     * @return array|bool|false|mixed|string|null
     */
    function cenv(?string $key = null, $default = null)
    {
        if (is_null($key)) {
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
     * 获取 base path.
     */
    function base_path(string $path = null): ?string
    {
        if (! defined('BASE_PATH')) {
            return null;
        }

        if (! is_null($path)) {
            return BASE_PATH.'/'.trim($path, '/');
        }

        return BASE_PATH;
    }
}

if (! function_exists('event')) {
    /**
     * 调度事件.
     *
     * @param null $listeners
     */
    function event(Event $event, $listeners = null, bool $isDispatch = true): void
    {
        /** @var \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher */
        $dispatcher = app('event.dispatcher');

        $listeners = is_object($listeners) ? [$listeners] : (array) $listeners;

        $listeners = array_unique(array_merge(
            app('event.listener.collection')->get($event::class) ?? [],
            $listeners
        ));

        foreach ($listeners as $listener) {
            if (is_callable($listener)) {
                $dispatcher->addListener($event->getName(), $listener);
                continue;
            }

            is_string($listener) and $listener = app($listener);
            $listener instanceof ListenerInterface and $dispatcher->addListener($event->getName(), [$listener, 'handle']);
            $listener instanceof EventSubscriberInterface and $dispatcher->addSubscriber($listener);
        }

        $isDispatch and $dispatcher->dispatch($event, $event->getName());
    }
}

if (! function_exists('call')) {
    /**
     * 调用回调.
     *
     * @return mixed
     *
     * @throws \Invoker\Exception\InvocationException
     * @throws \Invoker\Exception\NotCallableException
     * @throws \Invoker\Exception\NotEnoughParametersException
     */
    function call(callable|string $callable, array $parameters = [])
    {
        return app('invoker')->call($callable, $parameters);
    }
}

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     */
    function class_basename(string|object $class): string
    {
        $class = is_object($class) ? $class::class : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('retry')) {
    /**
     * Retry an operation a given number of times.
     *
     * @param callable|null $when
     *
     * @return mixed
     *
     * @throws \Exception
     */
    function retry(int|array $times, callable $callback, int|Closure $sleepMilliseconds = 0, $when = null)
    {
        $attempts = 0;

        $backoff = [];

        if (is_array($times)) {
            $backoff = $times;

            $times = count($times) + 1;
        }

        beginning:
        ++$attempts;
        --$times;

        try {
            return $callback($attempts);
        } catch (Exception $exception) {
            if ($times < 1 || ($when && ! $when($exception))) {
                throw $exception;
            }

            $sleepMilliseconds = $backoff[$attempts - 1] ?? $sleepMilliseconds;

            if ($sleepMilliseconds) {
                usleep(value($sleepMilliseconds, $attempts, $exception) * 1000);
            }

            goto beginning;
        }
    }
}

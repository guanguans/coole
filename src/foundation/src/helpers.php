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
use Illuminate\Support\Collection;
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
     * 获取/设置指定的配置值.
     *
     * @param array|string|null $key
     * @param mixed             $default
     *
     * @return bool|\Coole\Foundation\App|mixed
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                app('config')[$k] = $v;
            }

            return true;
        }

        if (! is_null($default)) {
            return $default;
        }

        return app('config')[$key];
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

if (! function_exists('collect')) {
    /**
     * 创建集合.
     *
     * @param null $value
     *
     * @return \Illuminate\Support\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}

if (! function_exists('base_path')) {
    /**
     * 获取 base path.
     *
     * @return string|null
     */
    function base_path(string $path = null)
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
     * @param bool $isDispatch
     */
    function event(Event $event, $listeners = null, $isDispatch = true)
    {
        $dispatcher = app('event_dispatcher');

        $listeners = is_object($listeners) ? [$listeners] : (array) $listeners;

        $listeners = array_unique(array_merge(
            app('listener')->get(get_class($event)) ?? [],
            $listeners
        ));

        foreach ($listeners as $listener) {
            is_string($listener) && $listener = app($listener);
            $listener instanceof Closure && $dispatcher->addListener($event::getName(), $listener);
            $listener instanceof ListenerInterface && $dispatcher->addListener($event::getName(), [$listener, 'handle']);
            $listener instanceof EventSubscriberInterface && $dispatcher->addSubscriber($listener);
        }

        $isDispatch && $dispatcher->dispatch($event, $event::getName());
    }
}

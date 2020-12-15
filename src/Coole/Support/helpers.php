<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Coole\App;
use Guanguans\Coole\Event\Event;
use Guanguans\Coole\Event\ListenerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Tightenco\Collect\Support\Collection;

if (! function_exists('app')) {
    /**
     * 获取 app 共享实例.
     *
     * @return \Guanguans\Coole\App|mixed
     */
    function app(?string $abstract = null, array $parameters = [])
    {
        if (null === $abstract) {
            return App::getInstance();
        }

        return App::getInstance()->makeWith($abstract, $parameters);
    }
}

if (! function_exists('env')) {
    /**
     * 获取环境变量的值
     *
     * @param null $default
     *
     * @return array|bool|false|mixed|string|null
     */
    function env(?string $key = null, $default = null)
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

if (! function_exists('collect')) {
    /**
     * 创建集合.
     *
     * @param null $value
     *
     * @return \Tightenco\Collect\Support\Collection
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
        if (null !== $path) {
            return BASE_PATH.'/'.trim($path, '/');
        }

        return BASE_PATH;
    }
}

if (! function_exists('config_path')) {
    /**
     * 获取 config path.
     *
     * @return string|null
     */
    function config_path(string $path = null)
    {
        if (null !== $path) {
            return base_path('config'.'/'.trim($path, '/'));
        }

        return base_path('config');
    }
}

if (! function_exists('event')) {
    /**
     * 调度事件.
     *
     * @param null $listeners
     */
    function event(Event $event, $listeners = null)
    {
        $dispatcher = app('event_dispatcher');

        $listeners = is_object($listeners) ? [$listeners] : (array) $listeners;

        $listeners = array_unique(array_merge(
            app('listener')->get(get_class($event)) ?? [],
            $listeners
        ));

        foreach ($listeners as $listener) {
            is_string($listener) && $listener = app($listener);
            $listener instanceof Closure && $dispatcher->addListener($event->getName(), $listener);
            $listener instanceof ListenerInterface && $dispatcher->addListener($event->getName(), [$listener, 'handle']);
            $listener instanceof EventSubscriberInterface && $dispatcher->addSubscriber($listener);
        }

        $dispatcher->dispatch($event, $event->getName());
    }
}

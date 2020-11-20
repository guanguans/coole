<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Di\Container;

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $abstract
     *
     * @return mixed|\Guanguans\Coole\App
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->makeWith($abstract, $parameters);
    }
}

if (! function_exists('env')) {
    /**
     * @param null $value
     *
     * @return array|false|string
     */
    function env(string $name, $value = null)
    {
        if (null !== $value && false === getenv($name)) {
            return $value;
        }

        return getenv($name);
    }
}

if (! function_exists('base_path')) {
    /**
     * @return string|null
     */
    function base_path(string $path = '')
    {
        if (! defined('BASE_PATH')) {
            return null;
        }
        if (! empty($path)) {
            return BASE_PATH.'/'.trim($path, '/');
        }

        return BASE_PATH;
    }
}

if (! function_exists('config_path')) {
    /**
     * @return string|null
     */
    function config_path(string $path = '')
    {
        if (! empty($path)) {
            return base_path('config').'/'.trim($path, '/');
        }

        return base_path('config');
    }
}

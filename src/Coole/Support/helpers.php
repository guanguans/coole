<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Coole\App;
use Tightenco\Collect\Support\Collection;

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
            return App::getInstance();
        }

        return App::getInstance()->makeWith($abstract, $parameters);
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     */
    function value($value)
    {
        return $value instanceof \Closure ? $value() : $value;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string     $key
     * @param mixed|null $default
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if (false === $value) {
            return value($default);
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
     * Create a collection from the given value.
     *
     * @param mixed|null $value
     *
     * @return Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
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

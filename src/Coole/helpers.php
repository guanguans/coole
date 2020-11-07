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

if (! function_exists('config')) {
    /**
     * @param null $key
     * @param null $default
     *
     * @return \Guanguans\Coole\Config\Config|mixed
     */
    function config($key = null, $default = null)
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

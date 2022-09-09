<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation;

use RuntimeException;

abstract class Facade
{
    /**
     * @var \Coole\Foundation\App
     */
    protected static $app;

    /**
     * 已经解析的对象实例.
     *
     * @var array
     */
    protected static $resolvedInstance = [];

    /**
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    /**
     * 解析门面实例.
     *
     * @param $name
     *
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        if (static::$app) {
            return static::$resolvedInstance[$name] = static::$app[$name];
        }
    }

    /**
     * @return \Coole\Foundation\App
     */
    public static function getFacadeApplication()
    {
        return static::$app;
    }

    /**
     * @param $app
     */
    public static function setFacadeApplication(App $app)
    {
        static::$app = $app;
    }

    /**
     * @param $method
     * @param $args
     *
     * @return \RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}

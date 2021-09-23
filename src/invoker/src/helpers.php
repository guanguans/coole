<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

if (! function_exists('call')) {
    /**
     * 调用回调.
     *
     * @param callable|array|string $callable
     *
     * @return mixed
     *
     * @throws \Invoker\Exception\InvocationException
     * @throws \Invoker\Exception\NotCallableException
     * @throws \Invoker\Exception\NotEnoughParametersException
     */
    function call($callable, array $parameters = [])
    {
        return app('invoker')->call($callable, $parameters);
    }
}

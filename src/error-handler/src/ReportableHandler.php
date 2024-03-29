<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler;

use Illuminate\Support\Traits\ReflectsClosures;

/**
 * This is modified from https://github.com/laravel/framework.
 */
class ReportableHandler
{
    use ReflectsClosures;

    /**
     * The underlying callback.
     */
    protected \Closure $callback;

    /**
     * Indicates if reporting should stop after invoking this handler.
     */
    protected bool $shouldStop = false;

    /**
     * Create a new reportable handler instance.
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Invoke the handler.
     */
    public function __invoke(\Throwable $throwable): bool
    {
        $result = call_user_func($this->callback, $throwable);

        if (false === $result) {
            return false;
        }

        return ! $this->shouldStop;
    }

    /**
     * Determine if the callback handles the given exception.
     */
    public function handles(\Throwable $throwable): bool
    {
        foreach ($this->firstClosureParameterTypes($this->callback) as $type) {
            if (is_a($throwable, $type)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Indicate that report handling should stop after invoking this callback.
     *
     * @return $this
     */
    public function stop(): static
    {
        $this->shouldStop = true;

        return $this;
    }
}

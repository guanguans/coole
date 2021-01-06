<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Event;

class Event extends \Symfony\Contracts\EventDispatcher\Event
{
    const NAME = null;

    /**
     * 获取事件名称.
     */
    public static function getName(): string
    {
        if (static::NAME) {
            return static::NAME;
        }

        return static::class;
    }
}

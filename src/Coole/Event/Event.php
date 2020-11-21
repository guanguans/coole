<?php

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
    const  NAME = null;

    /**
     * @return string|null
     */
    public function getEventName()
    {
        if (static::NAME) {
            return static::NAME;
        }

        return static::class;
    }
}

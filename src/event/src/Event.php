<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Event;

use Symfony\Contracts\EventDispatcher\Event as SymfonyEvent;

class Event extends SymfonyEvent
{
    public const NAME = null;

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

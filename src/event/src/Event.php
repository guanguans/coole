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
    protected ?string $name = null;

    /**
     * 获取事件名称.
     */
    public function getName(): string
    {
        if (! $this->name) {
            $this->name = static::class;
        }

        return $this->name;
    }
}

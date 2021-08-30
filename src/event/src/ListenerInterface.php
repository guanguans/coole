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

interface ListenerInterface
{
    /**
     * 事件处理.
     *
     * @param \Coole\Event\Event $event
     *
     * @return mixed
     */
    public function handle(Event $event);
}

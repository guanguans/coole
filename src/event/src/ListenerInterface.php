<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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

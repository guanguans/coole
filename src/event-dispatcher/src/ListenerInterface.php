<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher;

interface ListenerInterface
{
    /**
     * 事件处理.
     *
     * @param object $event
     *
     * @return mixed|void
     */
    public function handle($event);
}

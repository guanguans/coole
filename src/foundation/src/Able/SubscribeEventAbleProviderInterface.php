<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Able;

use Coole\Foundation\App;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface SubscribeEventAbleProviderInterface
{
    /**
     * 服务订阅事件.
     *
     * @return mixed
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher);
}

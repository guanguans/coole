<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Foundation\Able;

use Guanguans\Coole\Foundation\App;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface EventListenerAbleProviderInterface
{
    /**
     * 服务订阅事件.
     *
     * @return mixed
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher);
}

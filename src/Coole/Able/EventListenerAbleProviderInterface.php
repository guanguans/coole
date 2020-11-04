<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Able;

use Guanguans\Coole\App;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface EventListenerAbleProviderInterface
{
    public function subscribe(App $pp, EventDispatcherInterface $dispatcher);
}

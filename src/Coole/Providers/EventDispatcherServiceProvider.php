<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Providers;

use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispatcherServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app->singleton(EventDispatcher::class, function ($app) {
            return new EventDispatcher();
        });
        $app->alias(EventDispatcher::class, 'event_dispatcher');
    }
}

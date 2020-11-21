<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Event;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Tightenco\Collect\Support\Collection as Listener;

class EventServiceProvider implements ServiceProviderInterface, AfterRegisterAbleProviderInterface
{
    public function register(Container $app)
    {
        $app->singleton(EventDispatcher::class, function ($app) {
            return new EventDispatcher();
        });
        $app->alias(EventDispatcher::class, 'event_dispatcher');

        $app->singleton('listener', function () {
            return new Listener();
        });
    }

    public function afterRegister(App $app)
    {
        $app['listener'] = $app['listener']->merge($app['config']['event']['listener'] ?? []);
    }
}

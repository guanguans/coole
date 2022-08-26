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
use Illuminate\Container\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class ServiceProvider implements ServiceProviderInterface, AfterRegisterAbleProviderInterface, BeforeRegisterAbleProviderInterface, BootAbleProviderInterface, SubscribeEventAbleProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function beforeRegister(App $app)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function afterRegister(App $app)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function boot(App $app)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function subscribe(App $app, EventDispatcherInterface $dispatcher)
    {
    }
}

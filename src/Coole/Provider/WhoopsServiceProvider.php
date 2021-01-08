<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Provider;

use Guanguans\Coole\Able\AfterRegisterAbleProviderInterface;
use Guanguans\Coole\Able\BootAbleProviderInterface;
use Guanguans\Coole\App;
use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsServiceProvider implements ServiceProviderInterface, BootAbleProviderInterface, AfterRegisterAbleProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app->singleton('whoops_error_page_handler', function ($app) {
            if (PHP_SAPI === 'cli') {
                return new PlainTextHandler();
            }

            return new PrettyPageHandler();
        });

        $app->singleton(Run::class, function ($app) {
            $run = new Run();
            $run->allowQuit(false);
            $run->pushHandler($app['whoops_error_page_handler']);

            return $run;
        });
        $app->alias(Run::class, 'whoops');
    }

    /**
     * {@inheritdoc}
     */
    public function afterRegister(App $app)
    {
        $this->boot($app);
    }

    /**
     * {@inheritdoc}
     */
    public function boot(App $app)
    {
        ErrorHandler::register();

        if ($app['debug']) {
            $app['whoops']->register();
        }
    }
}

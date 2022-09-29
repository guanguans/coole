<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Concerns;

use Coole\Foundation\App;
use Coole\Foundation\Events\ExceptionEvent;
use Coole\Foundation\Events\RequestHandledEvent;
use Coole\Foundation\Events\TerminateEvent;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent as KernelExceptionEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\TerminateEvent as KernelTerminateEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will not return for `addKernelRequestHandler`.', function (): void {
    expect($this->app)
        ->addKernelRequestHandler(function (RequestEvent $requestEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelExceptionHandler`.', function (): void {
    expect($this->app)
        ->addKernelExceptionHandler(function (KernelExceptionEvent $exceptionEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelControllerHandler`.', function (): void {
    expect($this->app)
        ->addKernelControllerHandler(function (ControllerEvent $controllerEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelControllerArgumentsHandler`.', function (): void {
    expect($this->app)
        ->addKernelControllerArgumentsHandler(function (ControllerArgumentsEvent $controllerArgumentsEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelViewHandler`.', function (): void {
    expect($this->app)
        ->addKernelViewHandler(function (ViewEvent $viewEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelResponseHandler`.', function (): void {
    expect($this->app)
        ->addKernelResponseHandler(function (RequestEvent $requestEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelFinishRequestHandler`.', function (): void {
    expect($this->app)
        ->addKernelFinishRequestHandler(function (FinishRequestEvent $finishRequestEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addKernelTerminateHandler`.', function (): void {
    expect($this->app)
        ->addKernelTerminateHandler(function (KernelTerminateEvent $terminateEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addExceptionHandler`.', function (): void {
    expect($this->app)
        ->addExceptionHandler(function (ExceptionEvent $exceptionEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addRequestHandledHandler`.', function (): void {
    expect($this->app)
        ->addRequestHandledHandler(function (RequestHandledEvent $requestHandledEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will not return for `addTerminateHandler`.', function (): void {
    expect($this->app)
        ->addTerminateHandler(function (TerminateEvent $terminateEvent): void {
        })
        ->toBeNull();
})->group(__DIR__, __FILE__);

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler\Tests;

use Coole\ErrorHandler\ErrorHandler;
use Coole\ErrorHandler\ExceptionRendererInterface;
use Coole\ErrorHandler\ReportableHandler;
use Coole\ErrorHandler\Tests\stubs\HasContextMethodExceptionStub;
use Coole\ErrorHandler\Tests\stubs\HasGetInnerExceptionMethodExceptionStub;
use Coole\ErrorHandler\Tests\stubs\HasRenderMethodExceptionStub;
use Coole\ErrorHandler\Tests\stubs\HasReportMethodExceptionStub;
use Coole\ErrorHandler\Tests\stubs\MapToExceptionStub;
use Coole\ErrorHandler\Tests\stubs\ResponsableExceptionStub;
use Coole\Foundation\App;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../foundation/config/app.php');
});

it('will return `ReportableHandler` for `reportable`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->reportable(
            new class() {
                public function __invoke(\Throwable $throwable): void
                {
                }
            }
        )
        ->toBeInstanceOf(ReportableHandler::class)
        ->reportable(function (\Throwable $throwable): void {
        })
        ->toBeInstanceOf(ReportableHandler::class);
})->group(__DIR__, __FILE__);

it('will return self for `renderable`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->renderable(
            new class() {
                public function __invoke(\Throwable $throwable): void
                {
                }
            }
        )
        ->toBeInstanceOf(ErrorHandler::class)
        ->renderable(function (\Throwable $throwable): void {
        })
        ->toBeInstanceOf(ErrorHandler::class);
})->group(__DIR__, __FILE__);

it('will throws `InvalidArgumentException` for `map`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->map(
            function (\Throwable $throwable): void {
            },
            MapToExceptionStub::class
        )
        ->toBeInstanceOf(ErrorHandler::class);
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class);

it('will return self for `map`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->map(function (\Throwable $throwable): void {
        })
        ->toBeInstanceOf(ErrorHandler::class);
})->group(__DIR__, __FILE__);

it('will return self for `ignore`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->ignore(\InvalidArgumentException::class)
        ->toBeInstanceOf(ErrorHandler::class);
})->group(__DIR__, __FILE__);

it('will return self for `level`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->level(\InvalidArgumentException::class, LogLevel::NOTICE)
        ->toBeInstanceOf(ErrorHandler::class);
})->group(__DIR__, __FILE__);

it('will throws reporting exception for `report`.', function (): void {
    /** @var App $app */
    $app = clone $this->app;
    $app->offsetUnset(LoggerInterface::class);

    expect(new ErrorHandler($app))
        ->report(new \InvalidArgumentException())
        ->toBeNull();
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class);

it('will report exception for `report`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->ignore(\InvalidArgumentException::class)
        ->report(new \InvalidArgumentException())
        ->toBeNull();

    $errorHandler = new ErrorHandler($this->app);
    $errorHandler->map(fn (\Throwable $throwable): \Throwable => $throwable);
    $errorHandler->reportable(fn (\InvalidArgumentException $invalidArgumentException) => false);
    expect($errorHandler)
        ->report(new \InvalidArgumentException())
        ->toBeNull();

    expect(new ErrorHandler($this->app))
        ->report(new HasReportMethodExceptionStub())
        ->toBeNull();

    expect(new ErrorHandler($this->app))
        ->report(new HasGetInnerExceptionMethodExceptionStub())
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will return bool for `shouldReport`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->shouldReport(new HasReportMethodExceptionStub())
        ->toBeBool();
})->group(__DIR__, __FILE__);

it('will return array for `exceptionContext`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->report(new HasContextMethodExceptionStub())
        ->toBeNull();
})->group(__DIR__, __FILE__);

it('will return array&empty for `context`.', function (): void {
    $app = mock(App::class)
        ->shouldReceive('offsetGet')
        ->with(Request::class)
        ->andReturnNull()
        ->getMock();

    expect(invade(new ErrorHandler($app)))
        ->context()
        ->toBeArray()
        ->toBeEmpty();
})->group(__DIR__, __FILE__);

it('will render exception response for `render`.', function (): void {
    expect(new ErrorHandler($this->app))
        ->render($request = Request::createFromGlobals(), new HasRenderMethodExceptionStub())
        ->toBeInstanceOf(Response::class)
        ->render($request, new ResponsableExceptionStub())
        ->toBeInstanceOf(Response::class)
        ->render($request, new HasContextMethodExceptionStub())
        ->toBeInstanceOf(Response::class);

    $this->app['config']['app.debug'] = true;
    $errorHandler = new ErrorHandler($this->app);
    $errorHandler->renderable(fn (\InvalidArgumentException $throwable, Request $request) => new Response());

    expect($errorHandler)
        ->render($request, new \InvalidArgumentException())
        ->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will return `Response` for `renderExceptionResponse`.', function (): void {
    $m = mock(Request::class);
    $m->shouldReceive('getAcceptableContentTypes')->andReturn([
        'application/json',
    ]);
    $request = $m->shouldReceive('isXmlHttpRequest')
        ->set('headers', new HeaderBag())
        ->andReturnTrue()
        ->getMock();

    $this->app['config']['app.debug'] = true;
    expect(invade(new ErrorHandler($this->app)))
        ->renderExceptionResponse($request, new \InvalidArgumentException())
        ->toBeInstanceOf(JsonResponse::class);
})->group(__DIR__, __FILE__);

it('will return `Response` for `prepareResponse`.', function (): void {
    $this->app['config']['app.debug'] = true;

    expect(invade(new ErrorHandler($this->app)))
        ->prepareResponse(Request::createFromGlobals(), new \InvalidArgumentException())
        ->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will return `Response` for `renderExceptionContent`.', function (): void {
    $this->app['config']['app.debug'] = true;
    $this->app->bind(ExceptionRendererInterface::class, 'ExceptionRendererInterface');

    expect(invade(new ErrorHandler($this->app)))
        ->renderExceptionContent(new \InvalidArgumentException())
        ->toBeString();
})->group(__DIR__, __FILE__);

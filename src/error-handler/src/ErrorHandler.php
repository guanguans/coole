<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\ErrorHandler;

use Closure;
use Coole\Foundation\App;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Reflector;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\ReflectsClosures;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ErrorHandler implements ErrorHandlerInterface
{
    use ReflectsClosures;

    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [];

    /**
     * The callbacks that should be used during reporting.
     *
     * @var \Coole\ErrorHandler\ReportableHandler[]
     */
    protected $reportCallbacks = [];

    /**
     * A map of exceptions with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * The callbacks that should be used during rendering.
     *
     * @var \Closure[]
     */
    protected $renderCallbacks = [];

    /**
     * The registered exception mappings.
     *
     * @var array<string, \Closure>
     */
    protected $exceptionMap = [];

    /**
     * A list of the internal exception types that should not be reported.
     *
     * @var string[]
     */
    protected $internalDontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        MultipleRecordsFoundException::class,
        RecordsNotFoundException::class,
        SuspiciousOperationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Create a new exception handler instance.
     *
     * @return void
     */
    public function __construct(protected App $app)
    {
        $this->register();
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Register a reportable callback.
     *
     * @return \Coole\ErrorHandler\ReportableHandler
     */
    public function reportable(callable $reportUsing)
    {
        if (! $reportUsing instanceof Closure) {
            $reportUsing = Closure::fromCallable($reportUsing);
        }

        return tap(new ReportableHandler($reportUsing), function ($callback) {
            $this->reportCallbacks[] = $callback;
        });
    }

    /**
     * Register a renderable callback.
     *
     * @return $this
     */
    public function renderable(callable $renderUsing)
    {
        if (! $renderUsing instanceof Closure) {
            $renderUsing = Closure::fromCallable($renderUsing);
        }

        $this->renderCallbacks[] = $renderUsing;

        return $this;
    }

    /**
     * Register a new exception mapping.
     *
     * @param \Closure|string|null $to
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function map(Closure|string $from, $to = null)
    {
        if (is_string($to)) {
            $to = static fn ($exception) => new $to('', 0, $exception);
        }

        if (is_callable($from) && is_null($to)) {
            $from = $this->firstClosureParameterType($to = $from);
        }

        if (! is_string($from) || ! $to instanceof Closure) {
            throw new InvalidArgumentException('Invalid exception mapping.');
        }

        $this->exceptionMap[$from] = $to;

        return $this;
    }

    /**
     * Indicate that the given exception type should not be reported.
     *
     * @return $this
     */
    public function ignore(string $class)
    {
        $this->dontReport[] = $class;

        return $this;
    }

    /**
     * Set the log level for the given exception type.
     *
     * @param class-string<\Throwable> $type
     * @param \Psr\Log\LogLevel::*     $level
     *
     * @return $this
     */
    public function level($type, $level)
    {
        $this->levels[$type] = $level;

        return $this;
    }

    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $e)
    {
        $e = $this->mapException($e);

        if ($this->shouldntReport($e)) {
            return;
        }

        if (Reflector::isCallable($reportCallable = [$e, 'report']) && false !== $this->app->call($reportCallable)) {
            return;
        }

        foreach ($this->reportCallbacks as $reportCallback) {
            if ($reportCallback->handles($e) && false === $reportCallback($e)) {
                return;
            }
        }

        try {
            $logger = $this->app->make(LoggerInterface::class);
        } catch (Exception) {
            throw $e;
        }

        $level = Arr::first($this->levels, static fn ($level, $type) => $e instanceof $type, LogLevel::ERROR);

        $logger->log(
            $level,
            $e->getMessage(),
            array_merge(
                $this->exceptionContext($e),
                $this->context(),
                $e->getTrace(),
                ['exception' => $e]
            )
        );
    }

    /**
     * Determine if the exception should be reported.
     *
     * @return bool
     */
    public function shouldReport(Throwable $e)
    {
        return ! $this->shouldntReport($e);
    }

    /**
     * Determine if the exception is in the "do not report" list.
     *
     * @return bool
     */
    protected function shouldntReport(Throwable $e)
    {
        $dontReport = array_merge($this->dontReport, $this->internalDontReport);

        return ! is_null(Arr::first($dontReport, static fn ($type) => $e instanceof $type));
    }

    /**
     * Get the default exception context variables for logging.
     *
     * @return array
     */
    protected function exceptionContext(Throwable $e)
    {
        if (method_exists($e, 'context')) {
            return $e->context();
        }

        return [];
    }

    /**
     * Get the default context variables for logging.
     *
     * @return array
     */
    protected function context()
    {
        try {
            return array_filter([
                // 'ip' => '127.0.0.1',
            ]);
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return $response;
        }

        if ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($this->mapException($e));

        if ($response = $this->renderViaCallbacks($request, $e)) {
            return $response;
        }

        return match (true) {
            default => $this->renderExceptionResponse($request, $e),
        };
    }

    /**
     * Prepare exception for rendering.
     *
     * @return \Throwable
     */
    protected function prepareException(Throwable $e)
    {
        return match (true) {
            $e instanceof ModelNotFoundException => new NotFoundHttpException($e->getMessage(), $e),
            $e instanceof SuspiciousOperationException => new NotFoundHttpException('Bad hostname provided.', $e),
            $e instanceof RecordsNotFoundException => new NotFoundHttpException('Not found.', $e),
            default => $e,
        };
    }

    /**
     * Map the exception using a registered mapper if possible.
     *
     * @return \Throwable
     */
    protected function mapException(Throwable $e)
    {
        if (method_exists($e, 'getInnerException') &&
            ($inner = $e->getInnerException()) instanceof Throwable) {
            return $inner;
        }

        foreach ($this->exceptionMap as $class => $mapper) {
            if (is_a($e, $class)) {
                return $mapper($e);
            }
        }

        return $e;
    }

    /**
     * Try to render a response from request and exception via render callbacks.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function renderViaCallbacks($request, Throwable $e)
    {
        foreach ($this->renderCallbacks as $renderCallback) {
            foreach ($this->firstClosureParameterTypes($renderCallback) as $type) {
                if (is_a($e, $type)) {
                    $response = $renderCallback($e, $request);

                    if (! is_null($response)) {
                        return $response;
                    }
                }
            }
        }
    }

    /**
     * Render a default exception response if any.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderExceptionResponse($request, Throwable $e)
    {
        return $this->shouldReturnJson($request, $e)
                    ? $this->prepareJsonResponse($request, $e)
                    : $this->prepareResponse($request, $e);
    }

    /**
     * Determine if the exception handler response should be JSON.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    protected function shouldReturnJson($request, Throwable $e)
    {
        $acceptable = $request->getAcceptableContentTypes();

        return (
            $request->isXmlHttpRequest()
            && true != $request->headers->get('X-PJAX')
            && (
                [] === $acceptable
                || (isset($acceptable[0]) && ('*/*' === $acceptable[0] || '*' === $acceptable[0]))
            )
        ) || (
            isset($acceptable[0])
            && Str::contains(strtolower($acceptable[0]), ['/json', '+json'])
        );
    }

    /**
     * Prepare a response for the given exception.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function prepareResponse($request, Throwable $e)
    {
        if (! $this->isHttpException($e) && config('app.debug')) {
            return $this->convertExceptionToResponse($e);
        }

        if (! $this->isHttpException($e)) {
            $e = new HttpException(500, $e->getMessage());
        }

        return $this->renderHttpException($e);
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Throwable $e)
    {
        return new Response(
            $this->renderExceptionContent($e),
            $this->isHttpException($e) ? $e->getStatusCode() : 500,
            $this->isHttpException($e) ? $e->getHeaders() : []
        );
    }

    /**
     * Get the response content for the given exception.
     *
     * @return string
     */
    protected function renderExceptionContent(Throwable $e)
    {
        try {
            return config('app.debug')
                && app()->has(ExceptionRendererInterface::class)
                ? $this->renderExceptionWithCustomRenderer($e)
                : $this->renderExceptionWithSymfony($e, config('app.debug'));
        } catch (Throwable $throwable) {
            return $this->renderExceptionWithSymfony($throwable, config('app.debug'));
        }
    }

    /**
     * Render an exception to a string using the registered `ExceptionRenderer`.
     *
     * @return string
     */
    protected function renderExceptionWithCustomRenderer(Throwable $e)
    {
        return app(ExceptionRendererInterface::class)->render($e);
    }

    /**
     * Render an exception to a string using Symfony.
     *
     * @param bool $debug
     *
     * @return string
     */
    protected function renderExceptionWithSymfony(Throwable $e, $debug)
    {
        $renderer = new HtmlErrorRenderer($debug);

        return $renderer->render($e)->getAsString();
    }

    /**
     * Render the given HttpException.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $e)
    {
        return $this->convertExceptionToResponse($e);
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function prepareJsonResponse($request, Throwable $e)
    {
        $jsonResponse = new JsonResponse(
            $this->convertExceptionToArray($e),
            $this->isHttpException($e) ? $e->getStatusCode() : 500,
            $this->isHttpException($e) ? $e->getHeaders() : []
        );

        return $jsonResponse->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Convert the given exception to an array.
     *
     * @return array
     */
    protected function convertExceptionToArray(Throwable $e)
    {
        return config('app.debug') ? [
            'message' => $e->getMessage(),
            'exception' => $e::class,
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => collect($e->getTrace())->map(static fn ($trace) => Arr::except($trace, ['args']))->all(),
        ] : [
            'message' => $this->isHttpException($e) ? $e->getMessage() : 'Server Error',
        ];
    }

    /**
     * Render an exception to the console.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     *
     * @internal this method is not meant to be used or overwritten outside the framework
     */
    public function renderForConsole($output, Throwable $e)
    {
        $this->app['console']->renderThrowable($e, $output);
    }

    /**
     * Determine if the given exception is an HTTP exception.
     *
     * @return bool
     */
    protected function isHttpException(Throwable $e)
    {
        return $e instanceof HttpExceptionInterface;
    }
}

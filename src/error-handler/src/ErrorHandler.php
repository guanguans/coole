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
    public function report(Throwable $throwable)
    {
        $throwable = $this->mapException($throwable);

        if ($this->shouldntReport($throwable)) {
            return;
        }

        if (Reflector::isCallable($reportCallable = [$throwable, 'report']) && false !== $this->app->call($reportCallable)) {
            return;
        }

        foreach ($this->reportCallbacks as $reportCallback) {
            if ($reportCallback->handles($throwable) && false === $reportCallback($throwable)) {
                return;
            }
        }

        try {
            $logger = $this->app->make(LoggerInterface::class);
        } catch (Exception) {
            throw $throwable;
        }

        $level = Arr::first($this->levels, static fn ($level, $type) => $throwable instanceof $type, LogLevel::ERROR);

        $logger->log(
            $level,
            $throwable->getMessage(),
            array_merge(
                $this->exceptionContext($throwable),
                $this->context(),
                $throwable->getTrace(),
                ['exception' => $throwable]
            )
        );
    }

    /**
     * Determine if the exception should be reported.
     *
     * @return bool
     */
    public function shouldReport(Throwable $throwable)
    {
        return ! $this->shouldntReport($throwable);
    }

    /**
     * Determine if the exception is in the "do not report" list.
     *
     * @return bool
     */
    protected function shouldntReport(Throwable $throwable)
    {
        $dontReport = array_merge($this->dontReport, $this->internalDontReport);

        return ! is_null(Arr::first($dontReport, static fn ($type) => $throwable instanceof $type));
    }

    /**
     * Get the default exception context variables for logging.
     *
     * @return array
     */
    protected function exceptionContext(Throwable $throwable)
    {
        if (method_exists($throwable, 'context')) {
            return $throwable->context();
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
    public function render($request, Throwable $throwable)
    {
        if (method_exists($throwable, 'render') && $response = $throwable->render($request)) {
            return $response;
        }

        if ($throwable instanceof Responsable) {
            return $throwable->toResponse($request);
        }

        $throwable = $this->prepareException($this->mapException($throwable));

        if ($response = $this->renderViaCallbacks($request, $throwable)) {
            return $response;
        }

        return match (true) {
            default => $this->renderExceptionResponse($request, $throwable),
        };
    }

    /**
     * Prepare exception for rendering.
     *
     * @return \Throwable
     */
    protected function prepareException(Throwable $throwable)
    {
        return match (true) {
            $throwable instanceof ModelNotFoundException => new NotFoundHttpException($throwable->getMessage(), $throwable),
            $throwable instanceof SuspiciousOperationException => new NotFoundHttpException('Bad hostname provided.', $throwable),
            $throwable instanceof RecordsNotFoundException => new NotFoundHttpException('Not found.', $throwable),
            default => $throwable,
        };
    }

    /**
     * Map the exception using a registered mapper if possible.
     *
     * @return \Throwable
     */
    protected function mapException(Throwable $throwable)
    {
        if (method_exists($throwable, 'getInnerException') &&
            ($inner = $throwable->getInnerException()) instanceof Throwable) {
            return $inner;
        }

        foreach ($this->exceptionMap as $class => $mapper) {
            if (is_a($throwable, $class)) {
                return $mapper($throwable);
            }
        }

        return $throwable;
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
    protected function renderViaCallbacks($request, Throwable $throwable)
    {
        foreach ($this->renderCallbacks as $renderCallback) {
            foreach ($this->firstClosureParameterTypes($renderCallback) as $type) {
                if (is_a($throwable, $type)) {
                    $response = $renderCallback($throwable, $request);

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
    protected function renderExceptionResponse($request, Throwable $throwable)
    {
        return $this->shouldReturnJson($request, $throwable)
                    ? $this->prepareJsonResponse($request, $throwable)
                    : $this->prepareResponse($request, $throwable);
    }

    /**
     * Determine if the exception handler response should be JSON.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    protected function shouldReturnJson($request, Throwable $throwable)
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
    protected function prepareResponse($request, Throwable $throwable)
    {
        if (! $this->isHttpException($throwable) && config('app.debug')) {
            return $this->convertExceptionToResponse($throwable);
        }

        if (! $this->isHttpException($throwable)) {
            $throwable = new HttpException(500, $throwable->getMessage());
        }

        return $this->renderHttpException($throwable);
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Throwable $throwable)
    {
        return new Response(
            $this->renderExceptionContent($throwable),
            $this->isHttpException($throwable) ? $throwable->getStatusCode() : 500,
            $this->isHttpException($throwable) ? $throwable->getHeaders() : []
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
    protected function renderExceptionWithCustomRenderer(Throwable $throwable)
    {
        return app(ExceptionRendererInterface::class)->render($throwable);
    }

    /**
     * Render an exception to a string using Symfony.
     *
     * @param bool $debug
     *
     * @return string
     */
    protected function renderExceptionWithSymfony(Throwable $throwable, $debug)
    {
        $htmlErrorRenderer = new HtmlErrorRenderer($debug);

        return $htmlErrorRenderer->render($throwable)->getAsString();
    }

    /**
     * Render the given HttpException.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderHttpException(HttpExceptionInterface $httpException)
    {
        return $this->convertExceptionToResponse($httpException);
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function prepareJsonResponse($request, Throwable $throwable)
    {
        $jsonResponse = new JsonResponse(
            $this->convertExceptionToArray($throwable),
            $this->isHttpException($throwable) ? $throwable->getStatusCode() : 500,
            $this->isHttpException($throwable) ? $throwable->getHeaders() : []
        );

        return $jsonResponse->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Convert the given exception to an array.
     *
     * @return array
     */
    protected function convertExceptionToArray(Throwable $throwable)
    {
        return config('app.debug') ? [
            'message' => $throwable->getMessage(),
            'exception' => $throwable::class,
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'trace' => collect($throwable->getTrace())->map(static fn ($trace) => Arr::except($trace, ['args']))->all(),
        ] : [
            'message' => $this->isHttpException($throwable) ? $throwable->getMessage() : 'Server Error',
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
    public function renderForConsole($output, Throwable $throwable)
    {
        $this->app['console']->renderThrowable($throwable, $output);
    }

    /**
     * Determine if the given exception is an HTTP exception.
     *
     * @return bool
     */
    protected function isHttpException(Throwable $throwable)
    {
        return $throwable instanceof HttpExceptionInterface;
    }
}

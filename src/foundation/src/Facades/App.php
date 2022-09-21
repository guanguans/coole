<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Facades;

/**
 * @method static void                                                     abort(int $statusCode, string $message = '', array $headers = [])
 * @method static void                                                     addContextualBinding($concrete, $abstract, $implementation)
 * @method static void                                                     addExceptionHandler(callable $listener, int $priority = 0)
 * @method static \Coole\Foundation\App                                    addWithoutMiddleware(string|array $withoutMiddleware)
 * @method static void                                                     addKernelControllerArgumentsHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelControllerHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelExceptionHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelFinishRequestHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelRequestHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelResponseHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelTerminateHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addKernelViewHandler(callable $listener, int $priority = 0)
 * @method static \Coole\Foundation\App                                    addMiddleware(string|callable|array $middleware)
 * @method static void                                                     addRequestHandledHandler(callable $listener, int $priority = 0)
 * @method static void                                                     addTerminateHandler(callable $listener, int $priority = 0)
 * @method static void                                                     afterResolving($abstract, \Closure $callback = null)
 * @method static void                                                     alias($abstract, $alias)
 * @method static void                                                     beforeResolving($abstract, \Closure $callback = null)
 * @method static void                                                     bind($abstract, $concrete = null, $shared = false)
 * @method static void                                                     bindIf($abstract, $concrete = null, $shared = false)
 * @method static void                                                     bindMethod($method, $callback)
 * @method static void                                                     boot()
 * @method static bool                                                     bound($abstract)
 * @method static mixed                                                    build($concrete)
 * @method static mixed                                                    call($callback, array $parameters = [], $defaultMethod = null)
 * @method static mixed                                                    callMethodBinding($method, $instance)
 * @method static void                                                     commands(string|\Symfony\Component\Console\Command\Command|array $commands)
 * @method static void                                                     extend($abstract, \Closure $closure)
 * @method static \Closure                                                 factory($abstract)
 * @method static void                                                     flush()
 * @method static void                                                     flushMacros()
 * @method static void                                                     forgetExtenders($abstract)
 * @method static void                                                     forgetInstance($abstract)
 * @method static void                                                     forgetScopedInstances()
 * @method static mixed                                                    get(string $id)
 * @method static string                                                   getAlias($abstract)
 * @method static array                                                    getBindings()
 * @method static null|\Coole\HttpKernel\Controller                        getController(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getControllerMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getWithoutControllerMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getWithoutMiddleware()
 * @method static array                                                    getWithoutRequestMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getWithoutRouteMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Foundation\App                                    getInstance()
 * @method static array                                                    getMiddleware()
 * @method static array                                                    getRequestMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Routing\Route                                     getRoute(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getRouteMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                    getShouldExecutedRequestMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Symfony\Component\HttpFoundation\Response               handle(\Symfony\Component\HttpFoundation\Request $request, int $type = \Symfony\Component\HttpKernel\HttpKernelInterface::MAIN_REQUEST, bool $catch = true)
 * @method static bool                                                     has(string $id)
 * @method static bool                                                     hasMacro($name)
 * @method static bool                                                     hasMethodBinding($method)
 * @method static void                                                     instance($abstract, $instance)
 * @method static bool                                                     isAlias($name)
 * @method static bool                                                     isBooted()
 * @method static bool                                                     isShared($abstract)
 * @method static \Symfony\Component\HttpFoundation\JsonResponse           json(array $data = [], int $status = 200, array $headers = [])
 * @method static void                                                     loadCommandFrom(string $dir, string $namespace)
 * @method static void                                                     loadConfigFrom(string $path)
 * @method static void                                                     loadEnvFrom(string|array $paths)
 * @method static void                                                     loadRouteFrom(string $path)
 * @method static void                                                     macro($name, $macro)
 * @method static mixed                                                    make($abstract, array $parameters = [])
 * @method static mixed                                                    makeWith($abstract, array $parameters = [])
 * @method static void                                                     mergeConfig(array $value, string $key)
 * @method static void                                                     mergeConfigFrom(string $path, ?string $key = null)
 * @method static void                                                     mixin($mixin, $replace = true)
 * @method static bool                                                     offsetExists($key)
 * @method static mixed                                                    offsetGet($key)
 * @method static void                                                     offsetSet($key, $value)
 * @method static void                                                     offsetUnset($key)
 * @method static mixed                                                    rebinding($abstract, \Closure $callback)
 * @method static \Symfony\Component\HttpFoundation\RedirectResponse       redirect(string $url, int $status = 302, array $headers = [])
 * @method static mixed                                                    refresh($abstract, $target, $method)
 * @method static void                                                     register(\Coole\Foundation\ServiceProvider $serviceProvider)
 * @method static void                                                     registerProviders(array $providers)
 * @method static string                                                   render($name, array $context = [])
 * @method static void                                                     resolved(\Closure $callback)
 * @method static void                                                     resolving($abstract, \Closure $callback = null)
 * @method static \Symfony\Component\HttpFoundation\Response               response(?string $content = '', int $status = 200, array $headers = [])
 * @method static void                                                     run(?\Symfony\Component\HttpFoundation\Request $request = null)
 * @method static bool                                                     runningInConsole()
 * @method static void                                                     scoped($abstract, $concrete = null)
 * @method static void                                                     scopedIf($abstract, $concrete = null)
 * @method static \Symfony\Component\HttpFoundation\BinaryFileResponse     sendFile(\SplFileInfo|string $file, int $status = 200, array $headers = [], string $contentDisposition = null)
 * @method static \Symfony\Component\HttpFoundation\Response               sendRequestThroughPipeline(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Foundation\App                                    setWithoutMiddleware(string|array $withoutMiddleware)
 * @method static \Coole\Foundation\App                                    setInstance(\Illuminate\Contracts\Container\Container $container = null)
 * @method static \Coole\Foundation\App                                    setMiddleware(string|callable|array $middleware)
 * @method static void                                                     singleton($abstract, $concrete = null)
 * @method static void                                                     singletonIf($abstract, $concrete = null)
 * @method static \Symfony\Component\HttpFoundation\StreamedResponse       stream(callable $callback = null, int $status = 200, array $headers = [])
 * @method static void                                                     tag($abstracts, $tags)
 * @method static iterable                                                 tagged($tag)
 * @method static void                                                     terminate(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\HttpFoundation\Response $response)
 * @method static string                                                   version()
 * @method static \Illuminate\Contracts\Container\ContextualBindingBuilder when($concrete)
 * @method static \Closure                                                 wrap(\Closure $callback, array $parameters = [])
 *
 * @mixin \Coole\Foundation\App
 *
 * @see \Coole\Foundation\App
 */
class App extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'app';
    }
}

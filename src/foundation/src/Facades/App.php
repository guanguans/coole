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
 * @method static void                                                 register(\Coole\Foundation\ServiceProvider $provider)
 * @method static void                                                 addOptions(array $options)
 * @method static string                                               version()
 * @method static void                                                 loadEnvsFrom($paths)
 * @method static void                                                 loadConfigsFrom(string $path, bool $force = true)
 * @method static void                                                 loadRoutesFrom(string $path)
 * @method static void                                                 loadCommandsFrom(string $dir, string $namespace, string $suffix = '*Command.php')
 * @method static void                                                 setOptions(array $options)
 * @method static void                                                 mergeConfig(array $configs)
 * @method static void                                                 addConfig(array $configs)
 * @method static void                                                 registerProviders(array $providers)
 * @method static array                                                makeMiddleware(array $middleware)
 * @method static array                                                getCurrentRequestShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                getControllerShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static array                                                getRouteShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static string                                               render($name, $context = [])
 * @method static \Symfony\Component\HttpFoundation\RedirectResponse   redirect($url, $status = 302, array $headers = [])
 * @method static void                                                 abort($statusCode, $message = '', array $headers = [])
 * @method static \Symfony\Component\HttpFoundation\StreamedResponse   stream($callback = null, $status = 200, array $headers = [])
 * @method static \Symfony\Component\HttpFoundation\JsonResponse       json($data = [], $status = 200, array $headers = [])
 * @method static \Symfony\Component\HttpFoundation\BinaryFileResponse sendFile($file, $status = 200, array $headers = [], $contentDisposition = null)
 * @method static array                                                getMiddleware()
 * @method static void                                                 setMiddleware($middleware)
 * @method static void                                                 addMiddleware($middleware)
 * @method static void                                                 addFinishHandler($listener, int $priority = 0)
 * @method static mixed                                                make($abstract)
 * @method static mixed                                                makeWith($abstract, array $parameters)
 * @method static mixed                                                build($concrete)
 * @method static mixed                                                refresh($abstract, $target, $method)
 * @method static mixed                                                rebinding($abstract, \Closure $callback)
 * @method static mixed                                                bindIf($abstract, $concrete = null, $shared = false)
 * @method static void                                                 singleton($abstract, $concrete = null)
 * @method static void                                                 bind($abstract, $concrete = null, $shared = false)
 * @method static void                                                 extend($abstract, \Closure $closure)
 * @method static mixed                                                call($callback, array $parameters = [], $defaultMethod = null)
 * @method static void                                                 alias($abstract, $alias)
 * @method static void                                                 tag($abstracts, $tags)
 * @method static array                                                tagged($tag)
 * @method static \Closure                                             factory($abstract)
 * @method static \Closure                                             wrap(\Closure $callback, array $parameters = [])
 * @method static bool                                                 has($id)
 * @method static mixed                                                get($id)
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

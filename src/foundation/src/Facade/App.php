<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Facade;

/**
 * @method static \Coole\Foundation\App register(\Guanguans\Di\ServiceProviderInterface $provider)
 * @method static \Coole\Foundation\App addOptions(array $options)
 * @method static \Coole\Foundation\App version()
 * @method static \Coole\Foundation\App loadEnv($paths)
 * @method static \Coole\Foundation\App loadConfig(string $path)
 * @method static \Coole\Foundation\App loadRoute(string $path)
 * @method static \Coole\Foundation\App loadCommand(string $dir, string $namespace, string $suffix = '*Command.php')
 * @method static \Coole\Foundation\App setOptions(array $options)
 * @method static \Coole\Foundation\App mergeConfig(array $configs)
 * @method static \Coole\Foundation\App addConfig(array $configs)
 * @method static \Coole\Foundation\App registerProviders(array $providers)
 * @method static \Coole\Foundation\App makeMiddleware($middleware)
 * @method static \Coole\Foundation\App getCurrentRequestShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Foundation\App getControllerShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Foundation\App getRouteShouldExecutedMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Coole\Foundation\App render($name, $context = [])
 * @method static \Coole\Foundation\App redirect($url, $status = 302, array $headers = [])
 * @method static \Coole\Foundation\App abort($statusCode, $message = '', array $headers = [])
 * @method static \Coole\Foundation\App stream($callback = null, $status = 200, array $headers = [])
 * @method static \Coole\Foundation\App json($data = [], $status = 200, array $headers = [])
 * @method static \Coole\Foundation\App sendFile($file, $status = 200, array $headers = [], $contentDisposition = null)
 * @method static \Coole\Foundation\App getMiddleware()
 * @method static \Coole\Foundation\App setMiddleware($middleware)
 * @method static \Coole\Foundation\App addMiddleware($middleware)
 * @method static \Coole\Foundation\App addFinishHandler($listener, int $priority = 0)
 * @method static mixed make($abstract)
 * @method static mixed makeWith($abstract, array $parameters)
 * @method static mixed build($concrete)
 * @method static mixed refresh($abstract, $target, $method)
 * @method static mixed rebinding($abstract, \Closure $callback)
 * @method static mixed bindIf($abstract, $concrete = null, $shared = false)
 * @method static void singleton($abstract, $concrete = null)
 * @method static void bind($abstract, $concrete = null, $shared = false)
 * @method static void extend($abstract, \Closure $closure)
 * @method static mixed call($callback, array $parameters = [], $defaultMethod = null)
 * @method static void alias($abstract, $alias)
 * @method static void tag($abstracts, $tags)
 * @method static array tagged($tag)
 * @method static \Closure factory($abstract)
 * @method static \Closure wrap(\Closure $callback, array $parameters = [])
 * @method static bool has($id)
 * @method static mixed get($id)
 *
 * @see \Coole\Foundation\App
 * @see \Guanguans\Di\Container
 * @see \Coole\HttpKernel\Controller\HasControllerAble
 */
class App extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return 'app';
    }
}

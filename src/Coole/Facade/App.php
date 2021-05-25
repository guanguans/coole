<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Facade;

/**
 * @method static \Guanguans\Coole\App register(\Guanguans\Di\ServiceProviderInterface $provider)
 * @method static \Guanguans\Coole\App addOptions(array $options)
 * @method static \Guanguans\Coole\App version()
 * @method static \Guanguans\Coole\App loadEnv($paths)
 * @method static \Guanguans\Coole\App loadConfig(string $path)
 * @method static \Guanguans\Coole\App loadRoute(string $path)
 * @method static \Guanguans\Coole\App loadCommand(string $dir, string $namespace, string $suffix = '*Command.php')
 * @method static \Guanguans\Coole\App setOptions(array $options)
 * @method static \Guanguans\Coole\App mergeConfig(array $configs)
 * @method static \Guanguans\Coole\App addConfig(array $configs)
 * @method static \Guanguans\Coole\App registerProviders(array $providers)
 * @method static \Guanguans\Coole\App makeMiddleware($middleware)
 * @method static \Guanguans\Coole\App getCurrentRequestMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Guanguans\Coole\App getControllerMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Guanguans\Coole\App getRouteMiddleware(\Symfony\Component\HttpFoundation\Request $request)
 * @method static \Guanguans\Coole\App render($name, $context = [])
 * @method static \Guanguans\Coole\App redirect($url, $status = 302, array $headers = [])
 * @method static \Guanguans\Coole\App abort($statusCode, $message = '', array $headers = [])
 * @method static \Guanguans\Coole\App stream($callback = null, $status = 200, array $headers = [])
 * @method static \Guanguans\Coole\App json($data = [], $status = 200, array $headers = [])
 * @method static \Guanguans\Coole\App sendFile($file, $status = 200, array $headers = [], $contentDisposition = null)
 * @method static \Guanguans\Coole\App getMiddleware()
 * @method static \Guanguans\Coole\App setMiddleware($middleware)
 * @method static \Guanguans\Coole\App addMiddleware($middleware)
 * @method static \Guanguans\Coole\App addFinishHandler($listener, int $priority = 0)
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
 * @see \Guanguans\Coole\App
 * @see \Guanguans\Di\Container
 * @see \Guanguans\Coole\Controller\HasControllerAble
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

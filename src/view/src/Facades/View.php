<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\View\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static void                  addExtension(\Twig\Extension\ExtensionInterface $extension)
 * @method static void                  addFilter(\Twig\TwigFilter $filter)
 * @method static void                  addFunction(\Twig\TwigFunction $function)
 * @method static void                  addGlobal(string $name, $value)
 * @method static void                  addNodeVisitor(\Twig\NodeVisitor\NodeVisitorInterface $visitor)
 * @method static void                  addRuntimeLoader(\Twig\RuntimeLoader\RuntimeLoaderInterface $loader)
 * @method static void                  addTest(\Twig\TwigTest $test)
 * @method static void                  addTokenParser(\Twig\TokenParser\TokenParserInterface $parser)
 * @method static string                compile(\Twig\Node\Node $node)
 * @method static string                compileSource(\Twig\Source $source)
 * @method static \Twig\TemplateWrapper createTemplate(string $template, string $name = null)
 * @method static void                  disableAutoReload()
 * @method static void                  disableDebug()
 * @method static void                  disableStrictVariables()
 * @method static void                                        display($name, array $context = []): void
 * @method static void                                        enableAutoReload()
 * @method static void                                        enableDebug()
 * @method static void                                        enableStrictVariables()
 * @method static array                                       getBinaryOperators()
 * @method static \Twig\Cache\CacheInterface|string|false     getCache($original = true)
 * @method static string                                      getCharset()
 * @method static \Twig\Extension\ExtensionInterface          getExtension(string $class)
 * @method static array                                       getExtensions()
 * @method static null|\Twig\TwigFilter                       getFilter(string $name)
 * @method static array                                       getFilters()
 * @method static null|\Twig\TwigFunction                     getFunction(string $name)
 * @method static array                                       getFunctions()
 * @method static array                                       getGlobals()
 * @method static \Twig\Loader\LoaderInterface                getLoader()
 * @method static array                                       getNodeVisitors()
 * @method static object                                      getRuntime(string $class)
 * @method static string                                      getTemplateClass(string $name, int $index = null)
 * @method static null|\Twig\TwigTest                         getTest(string $name)
 * @method static array                                       getTests()
 * @method static null|\Twig\TokenParser\TokenParserInterface getTokenParser(string $name)
 * @method static array                                       getTokenParsers()
 * @method static array                                       getUnaryOperators()
 * @method static bool                                        hasExtension(string $class)
 * @method static bool                                        isAutoReload()
 * @method static bool                                        isDebug()
 * @method static bool                                        isStrictVariables()
 * @method static bool                                        isTemplateFresh(string $name, int $time)
 * @method static \Twig\TemplateWrapper                       load($name)
 * @method static \Twig\Template                              loadTemplate(string $cls, string $name, int $index = null)
 * @method static array                                       mergeGlobals(array $context)
 * @method static \Twig\Node\ModuleNode                       parse(\Twig\TokenStream $stream)
 * @method static void                                        registerUndefinedFilterCallback(callable $callable)
 * @method static void                                        registerUndefinedFunctionCallback(callable $callable)
 * @method static void                                        registerUndefinedTokenParserCallback(callable $callable)
 * @method static string                                      render($name, array $context = [])
 * @method static \Twig\TemplateWrapper                       resolveTemplate($names)
 * @method static void                                        setCache(\Twig\Cache\CacheInterface|string|false $cache)
 * @method static void                                        setCharset(string $charset)
 * @method static void                                        setCompiler(\Twig\Compiler $compiler)
 * @method static void                                        setExtensions(array $extensions)
 * @method static void                                        setLexer(\Twig\Lexer $lexer)
 * @method static void                                        setLoader(\Twig\Loader\LoaderInterface $loader)
 * @method static void                                        setParser(\Twig\Parser $parser)
 * @method static \Twig\TokenStream                           tokenize(\Twig\Source $source)
 *
 * @mixin  \Twig\Environment
 *
 * @see \Twig\Environment
 */
class View extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'view';
    }
}

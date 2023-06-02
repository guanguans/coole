<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static \Symfony\Component\Console\Command\Command|null          add(\Symfony\Component\Console\Command\Command $command)
 * @method static \Symfony\Component\Console\Command\Command[]             addCommands(array $commands)
 * @method static \Symfony\Component\Console\Command\Command[]             all(string $namespace = null)
 * @method static bool                                                     areExceptionsCaught()
 * @method static void                                                     complete(\Symfony\Component\Console\Completion\CompletionInput $input, \Symfony\Component\Console\Completion\CompletionSuggestions $suggestions)
 * @method static int                                                      doRun(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
 * @method static string                                                   extractNamespace(string $name, int $limit = null)
 * @method static \Symfony\Component\Console\Command\Command               find(string $name)
 * @method static string                                                   findNamespace(string $namespace)
 * @method static \Symfony\Component\Console\Command\Command               get(string $name)
 * @method static array                                                    getAbbreviations(array $names)
 * @method static \Symfony\Component\Console\Input\InputDefinition         getDefinition()
 * @method static string                                                   getHelp()
 * @method static \Symfony\Component\Console\Helper\HelperSet              getHelperSet()
 * @method static string                                                   getLongVersion()
 * @method static string                                                   getName()
 * @method static array                                                    getNamespaces()
 * @method static \Symfony\Component\Console\SignalRegistry\SignalRegistry getSignalRegistry()
 * @method static string                                                   getVersion()
 * @method static bool                                                     has(string $name)
 * @method static bool                                                     isAutoExitEnabled()
 * @method static bool                                                     isSingleCommand()
 * @method static \Symfony\Component\Console\Command\Command               register(string $name)
 * @method static void                                                     renderThrowable(\Throwable $e, \Symfony\Component\Console\Output\OutputInterface $output)
 * @method static mixed                                                    reset()
 * @method static int                                                      run(\Symfony\Component\Console\Input\InputInterface $input = null, \Symfony\Component\Console\Output\OutputInterface $output = null)
 * @method static void                                                     setAutoExit(bool $boolean)
 * @method static void                                                     setCatchExceptions(bool $boolean)
 * @method static void                                                     setCommandLoader(\Symfony\Component\Console\CommandLoader\CommandLoaderInterface $commandLoader)
 * @method static \Coole\Console\Application                               setDefaultCommand(string $commandName, bool $isSingleCommand = false)
 * @method static void                                                     setDefinition(\Symfony\Component\Console\Input\InputDefinition $definition)
 * @method static void                                                     setDispatcher(\Symfony\Contracts\EventDispatcher\EventDispatcherInterface $dispatcher)
 * @method static void                                                     setHelperSet(\Symfony\Component\Console\Helper\HelperSet $helperSet)
 * @method static void                                                     setName(string $name)
 * @method static void                                                     setSignalsToDispatchEvent(int ...$signalsToDispatchEvent)
 * @method static void                                                     setVersion(string $version)
 *
 * @mixin  \Coole\Console\Application
 *
 * @see \Coole\Console\Application
 */
class Console extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'console';
    }
}

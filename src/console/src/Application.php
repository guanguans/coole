<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console;

use Coole\ErrorHandler\ErrorHandlerInterface;
use Coole\Foundation\App;
use Coole\Foundation\Events\ExceptionEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * ``` php
 * use Coole\Console\Application;.
 *
 * $app = new Application(\Coole\Foundation\App::getInstance());
 * $status = $app->run();
 * exit($status);
 * ```
 */
class Application extends SymfonyApplication
{
    /**
     * logo.
     *
     * @var string
     */
    public const LOGO = <<<'coole'
        <fg=green;options=bold>
                                       __
                                      |  \
          _______   ______    ______  | $$  ______
         /       \ /      \  /      \ | $$ /      \
        |  $$$$$$$|  $$$$$$\|  $$$$$$\| $$|  $$$$$$\
        | $$      | $$  | $$| $$  | $$| $$| $$    $$
        | $$_____ | $$__/ $$| $$__/ $$| $$| $$$$$$$$
         \$$     \ \$$    $$ \$$    $$| $$ \$$     \
          \$$$$$$$  \$$$$$$   \$$$$$$  \$$  \$$$$$$$
        </>
        coole;

    public function __construct(protected App $app)
    {
        parent::__construct('Coole Framework', $app::version());
    }

    /**
     * {@inheritdoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null): int
    {
        try {
            $this->app->boot();

            $this->addCommands($this->app['console.command_collection']->all());

            return parent::run($input, $output);
        } catch (Throwable $throwable) {
            $this->app[EventDispatcherInterface::class]->dispatch(
                new ExceptionEvent($throwable)
            );

            $this->reportException($throwable);

            $this->renderException($output, $throwable);

            return 1;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHelp(): string
    {
        return parent::getHelp().PHP_EOL.static::LOGO;
    }

    /**
     * 报告异常.
     */
    protected function reportException(Throwable $throwable): void
    {
        $this->app[ErrorHandlerInterface::class]->report($throwable);
    }

    /**
     * 渲染异常.
     */
    protected function renderException(OutputInterface $output, Throwable $throwable): void
    {
        $this->app[ErrorHandlerInterface::class]->renderForConsole($output, $throwable);
    }
}

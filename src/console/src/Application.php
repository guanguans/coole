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
class Application extends \Symfony\Component\Console\Application
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
        parent::__construct('Coole Framework', $app->version());
    }

    public function run(InputInterface $input = null, OutputInterface $output = null): int
    {
        try {
            $this->app->boot();

            $this->addCommands($this->app['console.command.collection']->flatten()->all());

            return parent::run($input, $output);
        } catch (Throwable $throwable) {
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
     * Report the exception to the exception handler.
     *
     * @return void
     */
    protected function reportException(Throwable $throwable)
    {
        $this->app[ErrorHandlerInterface::class]->report($throwable);
    }

    /**
     * Render the given exception.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function renderException($output, Throwable $throwable)
    {
        $this->app[ErrorHandlerInterface::class]->renderForConsole($output, $throwable);
    }
}

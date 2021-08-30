<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coole\Console;

use Coole\Foundation\App;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
     * @var \Coole\Foundation\App
     */
    protected $app;

    /**
     * logo.
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

    public function __construct(App $app)
    {
        $this->app = $app;

        parent::__construct('Coole Framework', $app->version());
    }

    /**
     * {@inheritdoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->addCommands($this->app['command']->flatten()->all());

        return parent::doRun($input, $output);
    }

    /**
     * {@inheritdoc}
     */
    public function getHelp()
    {
        return parent::getHelp().PHP_EOL.static::LOGO;
    }
}

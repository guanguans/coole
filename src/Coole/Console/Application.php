<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console;

use Guanguans\Coole\App;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ``` php
 * if (PHP_SAPI !== 'cli' && PHP_MINOR_VERSION < 5) {
 *      echo 'Warning: phplint should be invoked via the CLI minimum version of PHP 5.5.9, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
 * }.
 *
 * $loaded = false;
 * foreach ([__DIR__.'/../../../autoload.php', __DIR__.'/../vendor/autoload.php'] as $file) {
 *      if (file_exists($file)) {
 *          require $file;
 *          $loaded = true;
 *          break;
 *      }
 * }
 * if (!$loaded) {
 *      die(
 *          'You need to set up the project dependencies using the following commands:'.PHP_EOL.
 *          'wget http://getcomposer.org/composer.phar'.PHP_EOL.
 *          'php composer.phar install'.PHP_EOL
 *      );
 * }
 *
 * use Guanguans\Coole\Console\Application;
 *
 * $app = new Application(\Guanguans\Coole\Application::getInstance());
 * $status = $app->run();
 * exit($status);
 * ```
 */
class Application extends \Symfony\Component\Console\Application
{
    protected $app;

    const LOGO = <<<'coole'
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

    protected $container;

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
        $this->app['command']->each(function ($commands) {
            $this->registerCommands($commands);
        });

        return parent::doRun($input, $output);
    }

    /**
     * {@inheritdoc}
     */
    public function getHelp()
    {
        return parent::getHelp().PHP_EOL.static::LOGO;
    }

    protected function registerCommands($commands = [])
    {
        $this->addCommands($commands);

        return $this;
    }
}

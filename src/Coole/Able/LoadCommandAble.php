<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Able;

use Guanguans\Coole\App;
use Guanguans\Coole\Console\CommandDiscoverer;

trait LoadCommandAble
{
    public function loadCommand(string $dir, string $namespace, string $suffix = '*Command.php')
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace, $suffix);
        if ($commands = $commandDiscoverer->getCommands()) {
            App::getInstance()['command']->add($commands);
        }

        return true;
    }
}

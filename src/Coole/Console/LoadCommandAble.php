<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console;

trait LoadCommandAble
{
    /**
     * 加载命令.
     */
    public function loadCommand(string $dir, string $namespace, string $suffix = '*Command.php')
    {
        $commandDiscoverer = new CommandDiscoverer($dir, $namespace, $suffix);
        if ($commands = $commandDiscoverer->getCommands()) {
            app('command')->add($commands);
        }
    }
}

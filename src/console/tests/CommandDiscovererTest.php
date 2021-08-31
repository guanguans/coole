<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Tests;

use Coole\Console\CommandDiscoverer;

class CommandDiscovererTest extends TestCase
{
    protected $commandDiscoverer;

    protected function setUp(): void
    {
        $this->commandDiscoverer = new CommandDiscoverer(__DIR__, 'Coole\Console\Tests');
    }

    public function testSetDir()
    {
        $dir = __DIR__.'/../';
        $this->assertInstanceOf(CommandDiscoverer::class, $this->commandDiscoverer->setDir($dir));
        $this->assertSame($this->commandDiscoverer->getDir(), $dir);
    }

    public function testSetNamespace()
    {
        $nameSpace = 'Coole\Console';
        $this->assertInstanceOf(CommandDiscoverer::class, $this->commandDiscoverer->setNamespace($nameSpace));
        $this->assertSame($this->commandDiscoverer->getNamespace(), $nameSpace);
    }

    public function testSetSuffix()
    {
        $suffix = '.go';
        $this->assertInstanceOf(CommandDiscoverer::class, $this->commandDiscoverer->setSuffix($suffix));
        $this->assertSame($this->commandDiscoverer->getSuffix(), $suffix);
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Guanguans\Coole\Tests\Console;

use Guanguans\Coole\Console\CommandDiscoverer;
use Guanguans\Coole\Tests\TestCase;

class CommandDiscovererTest extends TestCase
{
    protected $commandDiscoverer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandDiscoverer = new CommandDiscoverer(__DIR__, 'Guanguans\Coole\Tests\Console');
    }

    public function testSetDir()
    {
        $dir = __DIR__.'/../';
        $this->assertInstanceOf(CommandDiscoverer::class, $this->commandDiscoverer->setDir($dir));
        $this->assertSame($this->commandDiscoverer->getDir(), $dir);
    }

    public function testSetNamespace()
    {
        $nameSpace = 'Guanguans\Coole\Console';
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

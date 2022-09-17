<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher\Tests;

use Coole\EventDispatcher\Event;
use Mockery;

class EventTest extends TestCase
{
    public function testGetName(): void
    {
        $mock = Mockery::mock(Event::class)->makePartial();

        $this->assertIsString($mock->getName());
        $this->assertSame($mock::class, $mock->getName());
    }
}

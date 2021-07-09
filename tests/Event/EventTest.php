<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests\Event;

use Guanguans\Coole\Event\Event;
use Guanguans\Coole\Tests\TestCase;

class EventTest extends TestCase
{
    protected $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->event = new Event();
    }

    public function testGetName()
    {
        $this->assertIsString($this->event->getName());
        $eventStub = new EventStub();
        $this->assertIsString($eventStub->getName(), EventStub::NAME);
    }
}

class EventStub extends Event
{
    const NAME = 'eventName';
}

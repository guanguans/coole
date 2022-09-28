<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\EventDispatcher\Tests\stubs;

use Coole\EventDispatcher\ListenerInterface;

class ExampleListenerStub implements ListenerInterface
{
    public function handle($exampleEventStub): void
    {
    }
}

<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests;

use Guanguans\Coole\Coole;

class CooleTest extends TestCase
{
    public function testTest()
    {
        $this->assertTrue(Coole::test());
    }
}

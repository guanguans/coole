<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests;

use Guanguans\Coole\App;

class AppTest extends TestCase
{
    public function testVersion()
    {
        $this->assertIsString(App::version());
    }
}

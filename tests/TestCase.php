<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Tests;

use Guanguans\Coole\App;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = new App();
    }

    /**
     * Tear down the test case.
     */
    public function tearDown(): void
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Run extra tear down code.
     */
    protected function finish()
    {
        // call more tear down methods
    }
}

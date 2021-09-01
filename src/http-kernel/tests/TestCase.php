<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\HttpKernel\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        $this->finish();
    }

    /**
     * Run extra tear down code.
     */
    protected function finish()
    {
        // call more tear down methods
    }
}

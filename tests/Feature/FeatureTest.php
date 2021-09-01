<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Guanguans\Coole\Tests\Feature;

use Guanguans\Coole\Tests\TestCase;

class FeatureTest extends TestCase
{
    public function setUp(): void
    {
        passthru(sprintf('%s coole serve --docroot=%s --port=8008', PHP_BINARY, __DIR__));
    }

    public function testFeature()
    {
        $this->assertTrue(true);
    }
}

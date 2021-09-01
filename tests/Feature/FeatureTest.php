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
    public function testFeature()
    {
        $response = exec(sprintf('%s %s', PHP_BINARY, __DIR__.'/index.php'));

        $this->assertSame('This is the Coole framework.', $response);
    }
}

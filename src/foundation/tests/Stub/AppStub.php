<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Stub;

use Coole\Foundation\App;

class AppStub extends App
{
    public function getBooted()
    {
        return $this->booted;
    }

    public function setBooted($value)
    {
        $this->booted = $value;

        return $this;
    }
}

<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Stub;

use Guanguans\Di\Container;
use Guanguans\Di\ServiceProviderInterface;

class ServiceProviderStub implements ServiceProviderInterface
{
    public function register(Container $container)
    {
    }
}

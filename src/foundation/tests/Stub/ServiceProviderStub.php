<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Stub;

use Coole\Foundation\Able\ServiceProviderInterface;
use Illuminate\Container\Container;

class ServiceProviderStub implements ServiceProviderInterface
{
    public function register(Container $container)
    {
    }
}

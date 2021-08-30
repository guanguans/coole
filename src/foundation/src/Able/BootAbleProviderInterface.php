<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coole\Foundation\Able;

use Coole\Foundation\App;

interface BootAbleProviderInterface
{
    /**
     * 引导应用程序.
     *
     * @return mixed
     */
    public function boot(App $app);
}

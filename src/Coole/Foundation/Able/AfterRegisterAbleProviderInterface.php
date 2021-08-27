<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Foundation\Able;

use Guanguans\Coole\Foundation\App;

interface AfterRegisterAbleProviderInterface
{
    /**
     * 注册服务之后.
     *
     * @return mixed
     */
    public function afterRegister(App $app);
}

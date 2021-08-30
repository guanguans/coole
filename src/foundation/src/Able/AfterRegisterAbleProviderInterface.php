<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Able;

use Coole\Foundation\App;

interface AfterRegisterAbleProviderInterface
{
    /**
     * 注册服务之后.
     *
     * @return mixed
     */
    public function afterRegister(App $app);
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Concerns;

trait InteractsWithController
{
    use HasMiddleware;
    use InteractsWithAborting;
    use InteractsWithEventHandler;
    use InteractsWithResponse;
    use InteractsWithViewRender;
}

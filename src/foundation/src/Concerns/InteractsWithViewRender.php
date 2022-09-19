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

trait InteractsWithViewRender
{
    /**
     * {@inheritdoc}
     */
    public function render($name, array $context = []): string
    {
        return app('view')->render($name, $context);
    }
}

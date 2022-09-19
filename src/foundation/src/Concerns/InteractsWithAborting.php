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

use Symfony\Component\HttpKernel\Exception\HttpException;

trait InteractsWithAborting
{
    /**
     * 抛出 Http 异常.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function abort(int $statusCode, string $message = '', array $headers = []): void
    {
        throw new HttpException($statusCode, $message, null, $headers);
    }
}

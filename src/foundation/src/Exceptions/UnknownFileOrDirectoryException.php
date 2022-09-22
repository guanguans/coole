<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Exceptions;

class UnknownFileOrDirectoryException extends Exception
{
    public static function create(string $path): self
    {
        return new self(sprintf('File or directory not exist.: %s', $path));
    }
}

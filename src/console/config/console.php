<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

return [
    /*
     * 命令
     */
    'commands' => [
        [
            // 命令所在目录
            'dir' => __DIR__.'/../src/Commands',

            // 命令命名空间
            'namespace' => '\\Coole\\Console\\Commands',
        ],
    ],
];

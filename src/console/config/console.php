<?php

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
    'command' => [
        [
            // 命令文件所在目录
            'dir' => __DIR__.'/../src/Commands',

            // 命令文件命名空间
            'namespace' => '\Coole\Console\Commands',

            // 命令文件后缀
            'suffix' => '*Command.php',
        ],
    ],
];

# 错误处理

> 错误处理由 [symfony/error-handler](https://github.com/symfony/error-handler) 和 [filp/whoops](https://github.com/filp/whoops) 提供支持。

## 错误代码

``` php
<?php

declare(strict_types=1);

/*
 * This file is part of the coolephp/skeleton.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace App\Controller;

use Guanguans\Coole\Controller\Controller;

class IndexController extends Controller
{
    public function hello($hello)
    {
        return 'Coole'
    }
}
```

## 开启 debug

![](/static/on-debug.png)

## 关闭 debug

![](/static/off-debug.png)

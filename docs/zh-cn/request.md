# 请求

> 请求对象(Request)由 [symfony/http-foundation](https://github.com/symfony/http-foundation) 提供实现支持。

## 请求对象

``` php
<?php

namespace App\Controller;

use Guanguans\Coole\Foundation\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function hello(Request $request)
    {
        dump($request);
    }
}
```

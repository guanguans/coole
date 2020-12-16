# 视图

模板引擎由 [twig/twig](https://github.com/twigphp/Twig) 提供支持。

## 配置文件

默认 `config/view.php`。

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

return [
    'path' => base_path('view'),
    'options' => [
        'debug' => false,
        'charset' => 'UTF-8',
        'strict_variables' => false,
        'autoescape' => 'html',
        'cache' => base_path('runtime/views'),
        'auto_reload' => null,
        'optimizations' => -1,
    ],
];

```

## 使用(详细使用请参考[twig](https://twig.symfony.com/))

### 控制器

``` php
<?php

class ViewController
{
    public function index()
    {
        return $this->render('index.html', ['name' => 'Coole']);
    }
}
```

### 模板文件

``` html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>view</title>
</head>
<body>
<p>{{ name }}</p>
</body>
</html>
```

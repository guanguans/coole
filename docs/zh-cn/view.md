# 视图

模版引擎由 [twig/twig](https://github.com/twig/twig) 提供支持。

## 配置

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 `config/view.php` 配置。

``` php

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

## 使用

### 控制器

``` php
class ViewController
{
    public function index()
    {
        return $this->render('index.html', ['name' => 'Coole']);
    }
}
```

### 模板

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
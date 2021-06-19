<p align="center"><img src="./docs/static/logo.png" width="38%" alt="Coole"></p>

> Coole is a PHP micro-framework built on open source components. - Coole 是一个基于开源组件构建的 PHP 微框架。

[简体中文](README-CN.md) | [ENGLISH](README.md)

![Tests](https://github.com/guanguans/coole/workflows/Tests/badge.svg)
![Check & fix styling](https://github.com/guanguans/coole/workflows/Check%20&%20fix%20styling/badge.svg)
[![codecov](https://codecov.io/gh/guanguans/coole/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/coole)
[![Latest Stable Version](https://poser.pugx.org/guanguans/coole/v)](//packagist.org/packages/guanguans/coole)
[![Total Downloads](https://poser.pugx.org/guanguans/coole/downloads)](//packagist.org/packages/guanguans/coole)
[![License](https://poser.pugx.org/guanguans/coole/license)](//packagist.org/packages/guanguans/coole)

## 文档

[www.guanguans.cn/coole](https://www.guanguans.cn/coole/)

## 生命周期

<p align="center"><img src="./docs/static/life-cycle.png" alt="Life cycle"></p>

## 环境要求

* PHP >= 7.2

## 安装

``` shell script
$ composer require guanguans/coole -vvv
```

## 快速开始

``` php
<?php

use Guanguans\Coole\App;
use Guanguans\Coole\Facade\Router;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';

// 1. 创建应用
$app = new App();
$app['debug'] = true;

// 2. 添加一个带中间件的路由
Router::get('/', function (){
    return 'This is the Coole framework.';
})->setMiddleware(function (Request $request, Closure $next){
    $response = $next($request);
    $response->headers->set('X-Coole-Version', App::version());

    return $response;
});

// 3. 启动运行服务
$app->run();
```

## 测试

``` bash
$ composer test
```

## 变更日志

请参阅 [CHANGELOG](CHANGELOG.md) 获取最近有关更改的更多信息。

## 贡献指南

请参阅 [CONTRIBUTING](.github/CONTRIBUTING.md) 有关详细信息。

## 安全漏洞

请查看[我们的安全政策](../../security/policy)了解如何报告安全漏洞。

## 贡献者

* [guanguans](https://github.com/guanguans)
* [所有贡献者](../../contributors)

## 鸣谢

<a href="https://www.jetbrains.com" target="_blank">
    <img src="./docs/static/jetbrains.png" alt="jetbrains" width="200"/>
</a>

## 协议

MIT 许可证（MIT）。有关更多信息，请参见[协议文件](LICENSE)。

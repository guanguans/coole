# 日志

> 日志由 [monolog/monolog](https://github.com/Seldaek/monolog) 提供支持。

## 配置文件

默认 `config/logger.php`。

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

use Monolog\Logger;

return [
    'name' => 'app',
    'level' => Logger::DEBUG,
    'bubble' => true,
    'permission' => null,
    'log_file' => base_path('runtime/logs/app.log'),
    'use_locking' => false,
];
```

## 使用

``` php
use Guanguans\Coole\Facade\Logger;

Logger::log($level, $message, $context);
Logger::debug($level, $message, $context);
Logger::info($level, $message, $context);
Logger::notice($level, $message, $context);
Logger::warning($level, $message, $context);
Logger::error($level, $message, $context);
Logger::critical($level, $message, $context);
Logger::alert($level, $message, $context);
Logger::emergency($level, $message, $context);
```

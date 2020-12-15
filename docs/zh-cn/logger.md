# 日志

日志由 [monolog/monolog](https://github.com/monolog/monolog) 提供支持。

## 配置

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 `config/logger.php` 文件内完成的路由定义。

``` php
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

Logger::log($level, $message, $context = []);
Logger::debug($level, $message, $context = []);
Logger::info($level, $message, $context = []);
Logger::notice($level, $message, $context = []);
Logger::warning($level, $message, $context = []);
Logger::error($level, $message, $context = []);
Logger::critical($level, $message, $context = []);
Logger::alert($level, $message, $context = []);
Logger::emergency($level, $message, $context = []);
```
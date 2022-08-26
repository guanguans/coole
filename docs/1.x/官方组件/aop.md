# coolephp/goaop

> 提供 AOP 面向切面编程能力。

## 安装

``` bash
$ composer require coolephp/goaop -vvv
```

## 使用示例

### 配置

1. 复制 `goaop/config/goaop.php` 到 `coole-skeleton/config/goaop.php`。
2. 配置服务。

```php
```php
<?php

return [
    /*
     * App 名称
     */
    'name' => cenv('APP_NAME', 'Coole'),
    
    ...

    /*
     * 第三方服务
     */
    'providers' => [
        \Coole\Goaop\GoAopServiceProvider::class
    ],
    
    ...
];

```

3. `config/goaop.php` 中配置切面。

```php
```php
<?php

return [
    /*
     * AOP Debug Mode
     */
    'debug' => cenv('GOAOP_DEBUG', env('APP_DEBUG', false)),
    
    ...
    
    /*
     * Yours aspects
     */
    'aspects' => [
        \App\Aspect\LoggingServiceAspect::class,
    ],
];
```

### 创建 `app\Service\LoggingService`

```php
<?php

namespace App\Service;

class LoggingService
{
    public static function logging()
    {
        return true;
    }
}
```

### 定义切面 `App\Aspect\LoggingServiceAspect`

```php
<?php

namespace App\Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;

class LoggingServiceAspect implements Aspect
{
    /**
     * Method that will be called before real method.
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("execution(public App\Service\LoggingService::logging(*))")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        file_put_contents(base_path('runtime/logging.logger'), 'this is a before method testing.'.PHP_EOL, FILE_APPEND);
    }

    /**
     * Method that will be called after real method.
     *
     * @param MethodInvocation $invocation Invocation
     * @After("execution(public App\Service\LoggingService::logging(*))")
     */
    public function afterMethodExecution(MethodInvocation $invocation)
    {
        file_put_contents(base_path('runtime/logging.logger'), 'this is a after method testing.'.PHP_EOL, FILE_APPEND);
    }
}
```

### 执行 `App\Service\LoggingService::logging()`

cat `runtime/logging.log`

``` bash
───────┬───────────────────────────────────────────────────────────────────
       │ File: runtime/logging.log
───────┼───────────────────────────────────────────────────────────────────
   1   │ this is a before method testing.
   2   │ this is a after method testing.
───────┴───────────────────────────────────────────────────────────────────
```

## 源码链接

* [https://github.com/coolephp/goaop](https://github.com/coolephp/goaop)

## 相关链接

* [https://github.com/goaop/framework](https://github.com/goaop/framework)

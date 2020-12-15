# 事件

事件由 [symfony/event-dispatcher](https://github.com/symfony/event-dispatcher) 提供支持。

## 配置

在 [coolephp/skeleton](https://github.com/coolephp/skeleton) 骨架下，默认在 `config/view.php` 配置。

``` php
return [
    'listener' => [
        // \App\Event\ExampleEvent::class => [
        //     \App\Listener\ExampleListener::class
        // ]
    ],
];
```

## 触发事件

``` php
// 触发一个事件
event(new \App\Event\ExampleEvent());

// 绑定事件并且触发一个事件
event(new \App\Event\ExampleEvent(), \App\Listener\ExampleListener::class);
event(new \App\Event\ExampleEvent(), function (){
    dump('This is a testing.');
});
```
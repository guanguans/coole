# Changelog

All notable changes to `guanguans/coole` will be documented in this file

## 1.0.0 - 2020-12-17

* Initial release.

## 1.0.1 - 2020-12-29

* Add loading command able for app.
* Optimize some methods name.

## 1.0.2 - 2021-01-04

* Add automatic loading command file.
* Add automatic loading route file.
* Add app facade.
* Add loadEnv method for app.
* Add loadConfig method for app.
* Optimize global configuration file loading.
* Rename listeners->listener.
* Rename providers->provider.

## 1.0.3 - 2021-01-12

* Optimize whoops service provider.
* Fix monolog service provider config.
* Add a `KernelEvents::TERMINATE` event listener handler.
* Update `getName` of event method to static method.
* Optimize some methods of class.
* Rename tests/Controller/ControllerAbleTest.php -> tests/Controller/HasControllerAbleTest.php.
* Update name of monolog config option.
* Add formatter configurable for logger.
* Add time zone configurable.
* Optimize serve command.
* Optimize match method for Router.
* Rename: `src/Coole/Controller/ControllerAble.php` -> `src/Coole/Controller/HasControllerAble.php`.
* Rename `getAllMiddleware` -> `getCurrentRequestMiddleware`.
* Optimize `getControllerMiddleware` method.

## 1.0.4 - 2021-04-23

* Optimize the event scheduling function.
* Add a `setFinishHandler` method for controller.

## 1.1.0 - 2021-05-23

* Remove [topthink/think-orm](https://github.com/top-think/think-orm) expansion pack.
* Add [illuminate/database](https://github.com/illuminate/database) expansion pack.
* Rename `env()` -> `cenv()`.

## 1.1.1 - 2021-05-23

* Add database bootstrop.

## 1.1.2 - 2021-05-23

* Add [illuminate/pagination](https://github.com/illuminate/pagination) expansion pack.

## 1.1.3 - 2021-06-03

* Fix to convert requests into responses through middleware.
* Optimize controller resolver.

## 1.1.4 - 2021-07-31

* Add IDE helper files.
* Add code-lts/doctum.
* Add config function.
* Update php-cs-fixer config file.
* Rename sendRequestThroughHandle -> sendRequestThroughPipeline.
* Optimize `RoutingServiceProvider` default config.
* Optimize `TwigServiceProvider` default config.
* Optimize `MonologServiceProvider` default config.
* Optimize `AppServiceProvider` default config.
* Optimize `ConsoleServiceProvider` default config
* Optimize `makeMiddleware` method.

## 1.1.5 - 2021-08-25

Add `excludedMiddleware` feature.
Add `php-di/invoker`.

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
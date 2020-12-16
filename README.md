<p align="center"><img src="./docs/static/logo.png" width="38%" alt="Coole"></p>

> Coole is a PHP micro-framework based on open source excellent components.

![Tests](https://github.com/guanguans/coole/workflows/Tests/badge.svg)
![Check & fix styling](https://github.com/guanguans/coole/workflows/Check%20&%20fix%20styling/badge.svg)
[![codecov](https://codecov.io/gh/guanguans/coole/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/coole)
[![Latest Stable Version](https://poser.pugx.org/guanguans/coole/v)](//packagist.org/packages/guanguans/coole)
[![Total Downloads](https://poser.pugx.org/guanguans/coole/downloads)](//packagist.org/packages/guanguans/coole)
[![License](https://poser.pugx.org/guanguans/coole/license)](//packagist.org/packages/guanguans/coole)

## Documentation

[www.guanguans.cn/coole](https://www.guanguans.cn/coole/)

## Requirement

* PHP >= 7.2

## Installation

``` shell script
$ composer require guanguans/coole -vvv
```

## Quick start

``` php
<?php

use Guanguans\Coole\App;
use Guanguans\Coole\Facade\Router;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';

// 1. Create App.
$app = new App();
$app['debug'] = true;

// 2. Add route with closure middleware.
Router::get('/', function (){
    return 'This is the Coole framework.';
})->setMiddleware(function (Request $request, Closure $next){
    printf('Before request.<br>');
    $response = $next($request);
    printf('<br>After request.');

    return $response;
});

// 3. Listen and Running.
$app->run();
```

## Testing

``` bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [guanguans](https://github.com/guanguans)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

# coole

> The Coole Framework.

![Tests](https://github.com/guanguans/coole/workflows/Tests/badge.svg)
![Check & fix styling](https://github.com/guanguans/coole/workflows/Check%20&%20fix%20styling/badge.svg)
[![codecov](https://codecov.io/gh/guanguans/coole/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/coole)
[![Latest Stable Version](https://poser.pugx.org/guanguans/coole/v)](//packagist.org/packages/guanguans/coole)
[![Total Downloads](https://poser.pugx.org/guanguans/coole/downloads)](//packagist.org/packages/guanguans/coole)
[![License](https://poser.pugx.org/guanguans/coole/license)](//packagist.org/packages/guanguans/coole)

## Requirement

* PHP >= 7.2

## Installation

``` bash
$ composer require guanguans/coole -vvv
```

## Usage

``` php
<?php
// 1. Create App.
$app = new \Guanguans\Coole\App();

// 2. Add routes and middlewares.
$app['route']->get('/', function (){
    return 'This is the Coole framework.';
})->setMiddlewares(function (\Symfony\Component\HttpFoundation\Request $request, \Closure $next){
    printf('Before request. <br>');
    $response = $next($request);
    printf('<br> After request.');

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

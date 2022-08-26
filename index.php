<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Coole\Foundation\App;
use Coole\Routing\Facades\Router;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/vendor/autoload.php';

// 1. Create App.
$app = new App();
$app['debug'] = true;

// 2. Add route with closure middleware.
Router::get('/', function () {
    return 'This is the Coole framework.';
})->setMiddleware(function (Request $request, Closure $next) {
    $response = $next($request);
    $response->headers->set('X-Coole-Version', App::version());

    return $response;
});

// 3. Run service.
$app->run();

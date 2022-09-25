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

require __DIR__.'/bootstrap.php';

// 1. Create app.
$app = new App(['debug' => true]);

// Enable debugging(optional).
// $app['config']->set('app.debug', false);

// 2. Add route with closure middleware.
Router::get('/', static fn (App $app) => "This is the Coole framework(v{$app::version()}).")
    ->setMiddleware(static function (Request $request, Closure $next) {
        $response = $next($request);
        $response->headers->set('X-Coole-Version', App::version());

        return $response;
    });

// 3. Run service.
$app->run();

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

defined('COOLE_START') or define('COOLE_START', microtime(true));
defined('BASE_PATH') or define('BASE_PATH', __DIR__);

require __DIR__.'/vendor/autoload.php';

// 1. Create App.
$app = new App();

// 2. Add route with closure middleware.
Router::get('/', static fn () => 'This is the Coole framework.')
    ->setMiddleware(static function (Request $request, Closure $next) {
        $response = $next($request);
        $response->headers->set('X-Coole-Version', App::version());

        return $response;
    });

// 3. Run service.
$app->run();

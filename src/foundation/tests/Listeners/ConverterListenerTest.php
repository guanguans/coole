<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Foundation\Tests\Listeners;

use Coole\Foundation\App;
use Coole\Routing\Router;
use Symfony\Component\HttpFoundation\Request;

use function Pest\Faker\faker;

beforeEach(function (): void {
    $this->app = tap(new App())->loadConfigFrom(__DIR__.'/../../../foundation/config/app.php');
});

it('will not return for `onKernelController`.', function (): void {
    $this->app[Router::class]
        ->get($uri = faker()->uuid(), fn () => 'Closure')
        ->setOption('_converters', [
            'foo' => 'bar',
        ]);

    expect($this->app)
        ->run(Request::create($uri))
        ->toBeNull();
})->group(__DIR__, __FILE__);

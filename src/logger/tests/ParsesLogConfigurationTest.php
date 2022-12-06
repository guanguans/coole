<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Logger\Tests;

use Coole\Logger\ParsesLogConfiguration;

beforeEach(function (): void {
    $this->parsesLogConfiguration = new class() {
        use ParsesLogConfiguration;

        protected function getFallbackChannelName()
        {
            return 'foo';
        }
    };
});

it('will throws `InvalidArgumentException` for `level`.', function (): void {
    expect(invade($this->parsesLogConfiguration))->level([
        'level' => 'foo',
    ]);
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class, 'Invalid log level.');

it('will throws `InvalidArgumentException` for `actionLevel`.', function (): void {
    expect(invade($this->parsesLogConfiguration))->actionLevel([
        'action_level' => 'foo',
    ]);
})->group(__DIR__, __FILE__)->throws(\InvalidArgumentException::class, 'Invalid log action level.');

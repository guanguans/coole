<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->bootstrapFiles([
        __DIR__.'/vendor/autoload.php',
    ]);

    $rectorConfig->autoloadPaths([
        __DIR__.'/src/foundation/src/helpers.php',
    ]);

    $rectorConfig->paths([
        __DIR__.'/bin/coole',
        __DIR__.'/src',
        __DIR__.'/index.php',
        __DIR__.'/server.php',
    ]);

    $rectorConfig->skip([
        SimplifyIfReturnBoolRector::class,
    ]);

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        'App\SomeOldClass' => 'App\SomeNewClass',
    ]);

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    $rectorConfig->parameters()->set(Option::APPLY_AUTO_IMPORT_NAMES_ON_CHANGED_FILES_ONLY, true);
    $rectorConfig->importNames(true, false);
    $rectorConfig->phpstanConfig(__DIR__.'/phpstan.neon');
    $rectorConfig->phpVersion(8);
    $rectorConfig->nestedChainMethodCallLimit(3);
    // $rectorConfig->cacheDirectory(__DIR__.'/build/rector');
    // $rectorConfig->indent(' ', 4);
    // $rectorConfig->disableParallel();

    $rectorConfig->sets([
       LevelSetList::UP_TO_PHP_80,
    ]);
};

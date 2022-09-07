<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector;
use Rector\CodingStyle\Enum\PreferenceSelfThis;
use Rector\CodingStyle\Rector\ClassMethod\ReturnArrayClassMethodToYieldRector;
use Rector\CodingStyle\Rector\MethodCall\PreferThisOrSelfMethodCallRector;
use Rector\CodingStyle\ValueObject\ReturnArrayClassMethodToYield;
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

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
        StringClassNameToClassConstantRector::class,

        // tests
        '**/Fixture*',
        '**/Fixture/*',
        '**/Source*',
        '**/Source/*',
        '**/Expected/*',
        '**/Expected*',
    ]);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_80,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::NAMING,
        SetList::TYPE_DECLARATION,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::EARLY_RETURN,
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
    ]);

    $rectorConfig->parameters()->set(Option::APPLY_AUTO_IMPORT_NAMES_ON_CHANGED_FILES_ONLY, true);
    $rectorConfig->importNames(true, false);
    $rectorConfig->parallel();
    $rectorConfig->phpstanConfig(__DIR__.'/phpstan.neon');
    $rectorConfig->phpVersion(8);
    $rectorConfig->nestedChainMethodCallLimit(3);
    // $rectorConfig->cacheClass(FileCacheStorage::class);
    // $rectorConfig->cacheDirectory(__DIR__.'/build/rector');
    // $rectorConfig->indent(' ', 4);
    // $rectorConfig->disableParallel();

    $rectorConfig->rules([
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    $rectorConfig->ruleWithConfiguration(PreferThisOrSelfMethodCallRector::class, [
            'PHPUnit\Framework\TestCase' => PreferenceSelfThis::PREFER_THIS,
        ]
    );

    $rectorConfig->ruleWithConfiguration(ReturnArrayClassMethodToYieldRector::class, [
        new ReturnArrayClassMethodToYield('PHPUnit\Framework\TestCase', '*provide*'),
    ]);
};

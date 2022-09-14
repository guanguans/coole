<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$header = <<<EOF
This file is part of Coole.

@link     https://github.com/guanguans/coole
@contact  guanguans <ityaozm@gmail.com>
@license  https://github.com/guanguans/coole/blob/main/LICENSE
EOF;

$finder = Finder::create()
    ->in([
        __DIR__.'/src',
    ])
    ->append([
        __DIR__.'/.php-cs-fixer.php',
        __DIR__.'/doctum.php',
        __DIR__.'/index.php',
        __DIR__.'/LocalValetDriver.php',
        __DIR__.'/monorepo-builder.php',
        __DIR__.'/rector.php',
        __DIR__.'/server.php',
    ])
    ->exclude([
        '.github',
        'build',
        'doc',
        'docs',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('_ide_helper.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new Config())
    ->setRules([
        // '@PSR12' => true,
        '@Symfony' => true,
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'PHPDoc',
        ],
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'not_operator_with_successor_space' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'single_quote' => true,
        'class_attributes_separation' => true,
        'standardize_not_equals' => true,
        'declare_strict_types' => true,
        'trailing_comma_in_multiline' => true,
        'php_unit_construct' => true,
        'php_unit_strict' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);

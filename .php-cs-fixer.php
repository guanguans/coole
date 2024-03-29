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
        __DIR__.'/.phpstorm.meta.php',
        __DIR__.'/bootstrap.php',
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
        '@DoctrineAnnotation' => true,
        '@PHP80Migration:risky' => true,
        '@PHPUnit84Migration:risky' => true,
        '@PSR12:risky' => true,
        '@Symfony' => true,
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'PHPDoc',
        ],
        'blank_line_before_statement' => [
            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
        ],
        'comment_to_phpdoc' => [
            'ignored_tags' => [],
        ],
        'declare_strict_types' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'not_operator_with_successor_space' => true,
        'no_useless_return' => true,
        'no_useless_else' => true,
        'is_null' => true,
        'return_assignment' => true,
        'multiline_comment_opening_closing' => true,
        'align_multiline_comment' => [
            'comment_type' => 'phpdocs_only',
        ],
        'phpdoc_to_comment' => [],
        'phpdoc_var_annotation_correct_order' => true,
        'php_unit_construct' => [
            'assertions' => ['assertEquals', 'assertSame', 'assertNotEquals', 'assertNotSame'],
        ],
        'array_indentation' => true,
        'method_chaining_indentation' => true,
        'statement_indentation' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);

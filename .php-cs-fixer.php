<?php

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

$header = <<<EOF
This file is part of Coole.

@link     https://github.com/guanguans/coole
@contact  guanguans <ityaozm@gmail.com>
@license  https://github.com/guanguans/coole/blob/main/LICENSE
EOF;

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__,
    ])
    ->exclude([
        __DIR__.'/vendor/',
        __DIR__.'/build/',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('_ide_helper.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        // '@PSR12' => true,
        '@Symfony' => true,
        'header_comment' => [
            'header' => $header,
            'comment_type' => 'PHPDoc'
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
        // 'trailing_comma_in_multiline' => true,
        // 'php_unit_construct' => true,
        // 'php_unit_strict' => true,
        // 'declare_strict_types' => true,
    ])
    // ->setRiskyAllowed(true)
    ->setFinder($finder);

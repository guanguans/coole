<?php

declare(strict_types = 1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Doctum\Doctum;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->in($dir = __DIR__.'/src/Coole');

$versions = GitVersionCollection::create($dir)
    // ->addFromTags('v1.*')
    ->add('main', 'main branch');

return new Doctum($iterator, [
        'theme'                => 'default',
        'versions'             => $versions,
        'title'                => 'Coole API',
        // 'build_dir'            => __DIR__.'/docs/api/%version%',
        'build_dir'            => __DIR__.'/docs/api/',
        'cache_dir'            => __DIR__.'/doctum-cache/api/%version%',
        'default_opened_level' => 2,
    ]
);

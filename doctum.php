<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Doctum\Doctum;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->in($dir = __DIR__.'/src/');

$versions = GitVersionCollection::create($dir)
    // ->addFromTags('v1.*')
    ->add('1.x', '1.x branch')
    ->add('main', 'main branch');

return new Doctum($iterator, [
        'theme' => 'default',
        'versions' => $versions,
        'title' => 'Coole API',
        'build_dir' => __DIR__.'/docs/api/%version%',
        // 'build_dir' => __DIR__.'/docs/api/',
        'cache_dir' => __DIR__.'/build/doctum/api/%version%',
        'default_opened_level' => 2,
        'footer_link' => [
            'href' => 'https://github.com/guanguans/coole',
            'rel' => 'noreferrer noopener',
            'target' => '_blank',
            'before_text' => 'You can edit the configuration',
            'link_text' => 'on this', // Required if the href key is set
            'after_text' => 'repository',
        ],
    ]
);

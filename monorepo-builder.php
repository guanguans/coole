<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\AddTagToChangelogReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushNextDevReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualConflictsReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetNextMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\UpdateBranchAliasReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\UpdateReplaceReleaseWorker;
use Symplify\MonorepoBuilder\ValueObject\Option;

/*
 * Monorepo Builder additional fields
 *
 * @see https://github.com/symplify/symplify/issues/2061
 */
\register_shutdown_function(static function () {
    $dest = \json_decode(\file_get_contents(__DIR__.'/composer.json'), true);

    $result = [
        'name' => 'guanguans/coole',
        'description' => $dest['description'] ?? '',
        'keywords' => $dest['keywords'] ?? [],
        'homepage' => 'https://github.com/guanguans/coole',
        'authors' => [
            [
                'name' => 'guanguans',
                'email' => 'ityaozm@gmail.com',
                'homepage' => 'https://www.guanguans.cn',
                'role' => 'developer',
            ],
        ],
        'type' => 'library',
        'license' => 'MIT',
        'minimum-stability' => $dest['minimum-stability'] ?? 'dev',
        'prefer-stable' => $dest['prefer-stable'] ?? true,
        'support' => [
            'issues' => 'https://github.com/guanguans/coole/issues',
            'source' => 'https://github.com/guanguans/coole',
        ],
        'require' => $dest['require'] ?? [],
        'require-dev' => $dest['require-dev'] ?? [],
        'autoload' => $dest['autoload'] ?? [],
        'autoload-dev' => $dest['autoload-dev'] ?? [],
        'replace' => $dest['replace'] ?? [],
        'config' => $dest['config'] ?? [],
        'extra' => $dest['extra'] ?? [],
        'scripts' => $dest['scripts'] ?? [],
        'scripts-descriptions' => $dest['scripts-descriptions'] ?? [],
    ];

    $json = \json_encode($result, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE);

    \file_put_contents(__DIR__.'/composer.json', $json."\n");
});

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::DEFAULT_BRANCH_NAME, '2.x');

    $parameters->set(Option::ROOT_DIRECTORY, [__DIR__]);

    $parameters->set(Option::PACKAGE_DIRECTORIES, ['src']);

    // $parameters->set(Option::SUBSPLIT_CACHE_DIRECTORY, 'src');

    $parameters->set(Option::PACKAGE_DIRECTORIES_EXCLUDES, []);

    $parameters->set(Option::DATA_TO_REMOVE, [
        'require' => [
            // remove these to merge of packages' composer.json
            // 'phpunit/phpunit' => '*',
        ],
    ]);
    $parameters->set(Option::DATA_TO_APPEND, [
        'type' => 'library',
        'require-dev' => [
            'brainmaestro/composer-git-hooks' => '^2.8',
            'friendsofphp/php-cs-fixer' => '^3.0',
            'mockery/mockery' => '^1.3',
            'nyholm/nsa' => '^1.3',
            'phpunit/phpunit' => '^8.0 || ^9.0',
            'vimeo/psalm' => '^4.9',
        ],
    ]);

    $parameters->set(Option::REPOSITORY, [
        'src/config' => 'git@github.com:coolephp/config.git',
    ]);

    $parameters->set(Option::EXCLUDE_PACKAGE, []);

    $services = $containerConfigurator->services();

    // release workers - in order to execute
    $services->set(UpdateReplaceReleaseWorker::class);
    $services->set(SetCurrentMutualConflictsReleaseWorker::class);
    $services->set(SetCurrentMutualDependenciesReleaseWorker::class);
    $services->set(AddTagToChangelogReleaseWorker::class);
    $services->set(TagVersionReleaseWorker::class);
    $services->set(PushTagReleaseWorker::class);
    $services->set(SetNextMutualDependenciesReleaseWorker::class);
    $services->set(UpdateBranchAliasReleaseWorker::class);
    $services->set(PushNextDevReleaseWorker::class);
};

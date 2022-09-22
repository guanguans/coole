<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace PHPSTORM_META;

/**
 * PhpStorm Meta file, to provide autocomplete information for PhpStorm.
 */
override(new \Illuminate\Contracts\Container\Container(), map([
    '' => '@',
]));
override(\App::get(0), map([
    '' => '@',
]));
override(\App::make(0), map([
    '' => '@',
]));
override(\App::makeWith(0), map([
    '' => '@',
]));
override(\app(0), map([
    '' => '@',
]));

override(\Illuminate\Support\Arr::add(0), type(0));
override(\Illuminate\Support\Arr::except(0), type(0));
override(\Illuminate\Support\Arr::first(0), elementType(0));
override(\Illuminate\Support\Arr::last(0), elementType(0));
override(\Illuminate\Support\Arr::get(0), elementType(0));
override(\Illuminate\Support\Arr::only(0), type(0));
override(\Illuminate\Support\Arr::prepend(0), type(0));
override(\Illuminate\Support\Arr::pull(0), elementType(0));
override(\Illuminate\Support\Arr::set(0), type(0));
override(\Illuminate\Support\Arr::shuffle(0), type(0));
override(\Illuminate\Support\Arr::sort(0), type(0));
override(\Illuminate\Support\Arr::sortRecursive(0), type(0));
override(\Illuminate\Support\Arr::where(0), type(0));

override(\array_add(0), type(0));
override(\array_except(0), type(0));
override(\array_first(0), elementType(0));
override(\array_last(0), elementType(0));
override(\array_get(0), elementType(0));
override(\array_only(0), type(0));
override(\array_prepend(0), type(0));
override(\array_pull(0), elementType(0));
override(\array_set(0), type(0));
override(\array_sort(0), type(0));
override(\array_sort_recursive(0), type(0));
override(\array_where(0), type(0));
override(\head(0), elementType(0));
override(\last(0), elementType(0));
override(\with(0), type(0));
override(\tap(0), type(0));
override(\optional(0), type(0));

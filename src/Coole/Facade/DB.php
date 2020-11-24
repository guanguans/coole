<?php

declare(strict_types=1);

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Facade;

/**
 * @method static \think\db\BaseQuery table($table)
 * @method static \think\db\BaseQuery name(string $name)
 *
 * @see \think\db\BaseQuery
 */
class DB extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'db';
    }
}

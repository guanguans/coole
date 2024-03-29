<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Database\Facades;

use Coole\Foundation\Facades\Facade;

/**
 * @method static \Doctrine\DBAL\Driver\PDOConnection      getPdo()
 * @method static \Illuminate\Database\ConnectionInterface connection(string $name = null)
 * @method static \Illuminate\Database\Query\Builder       table(string $table, string $as = null)
 * @method static \Illuminate\Database\Query\Builder       query()
 * @method static \Illuminate\Database\Query\Expression    raw($value)
 * @method static array                                    getQueryLog()
 * @method static array                                    prepareBindings(array $bindings)
 * @method static array                                    pretend(\Closure $callback)
 * @method static array                                    select(string $query, array $bindings = [], bool $useReadPdo = true)
 * @method static bool                                     insert(string $query, array $bindings = [])
 * @method static bool                                     logging()
 * @method static bool                                     statement(string $query, array $bindings = [])
 * @method static bool                                     unprepared(string $query)
 * @method static int                                      affectingStatement(string $query, array $bindings = [])
 * @method static int                                      delete(string $query, array $bindings = [])
 * @method static int                                      transactionLevel()
 * @method static int                                      update(string $query, array $bindings = [])
 * @method static mixed                                    selectOne(string $query, array $bindings = [], bool $useReadPdo = true)
 * @method static mixed                                    transaction(\Closure $callback, int $attempts = 1)
 * @method static string                                   getDefaultConnection()
 * @method static void                                     afterCommit(\Closure $callback)
 * @method static void                                     beginTransaction()
 * @method static void                                     commit()
 * @method static void                                     enableQueryLog()
 * @method static void                                     disableQueryLog()
 * @method static void                                     flushQueryLog()
 * @method static void                                     registerDoctrineType(string $class, string $name, string $type)
 * @method static \Illuminate\Database\Connection          beforeExecuting(\Closure $callback)
 * @method static void                                     listen(\Closure $callback)
 * @method static void                                     rollBack(int $toLevel = null)
 * @method static void                                     setDefaultConnection(string $name)
 *
 * @mixin  \Illuminate\Database\DatabaseManager
 * @mixin  \Illuminate\Database\Connection
 *
 * @see \Illuminate\Database\DatabaseManager
 * @see \Illuminate\Database\Connection
 */
class DB extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'db';
    }
}

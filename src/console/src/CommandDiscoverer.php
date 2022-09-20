<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console;

use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;

class CommandDiscoverer
{
    public function __construct(
        protected string $dir,
        protected string $namespace,
    ) {
    }

    /**
     * 获取命令.
     *
     * @return array<\Symfony\Component\Console\Command\Command>
     */
    public function getCommands(): array
    {
        $finder = Finder::create()
            ->files()
            ->in($this->dir)
            ->ignoreVCS(true)
            ->ignoreDotFiles(true)
            ->name('*.php');

        $commands = [];
        foreach ($finder as $file) {
            $class = Str::start("$this->namespace\\{$file->getBasename('.php')}", '\\');
            $command = app($class);
            $command instanceof Command and $commands[] = $command;
        }

        return $commands;
    }

    /**
     * 获取目录.
     */
    public function getDir(): string
    {
        return $this->dir;
    }

    /**
     * 设置目录.
     *
     * @return $this
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * 获取命名空间.
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * 设置命名空间.
     *
     * @return $this
     */
    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }
}

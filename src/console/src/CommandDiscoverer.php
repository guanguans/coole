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

use Symfony\Component\Finder\Finder;

class CommandDiscoverer
{
    public function __construct(
        /**
         * 目录.
         */
        protected string $dir,
        /**
         * 命名空间.
         */
        protected string $namespace,
        /**
         * 后缀
         */
        protected string $suffix = '*Command.php'
    ) {
    }

    /**
     * 获取命令.
     */
    public function getCommands(): array
    {
        $finder = Finder::create()
            ->files()
            ->in($this->dir)
            ->ignoreVCS(true)
            ->ignoreDotFiles(true)
            ->name($this->suffix);

        $commands = [];
        foreach ($finder as $file) {
            $class = '\\'.trim($this->namespace.'\\'.$file->getBasename('.php'), '\\');
            $command = app($class);
            $command instanceof Command && $commands[] = $command;
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

    /**
     * 获取后缀
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * 设置后缀
     *
     * @return $this
     */
    public function setSuffix(string $suffix): self
    {
        $this->suffix = $suffix;

        return $this;
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coole\Console;

use Symfony\Component\Finder\Finder;

class CommandDiscoverer
{
    /**
     * 目录.
     *
     * @var string
     */
    protected $dir = '';

    /**
     * 命名空间.
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * 后缀
     *
     * @var string
     */
    protected $suffix = '';

    public function __construct(string $dir, string $namespace, string $suffix = '*Command.php')
    {
        $this->dir = $dir;
        $this->namespace = $namespace;
        $this->suffix = $suffix;
    }

    /**
     * 获取命令.
     */
    public function getCommands(): array
    {
        $files = Finder::create()->files()->in($this->dir)->name($this->suffix);

        $commands = [];

        foreach ($files as $file) {
            $class = '\\'.trim($this->namespace.'\\'.$file->getBasename('.php'), '\\');
            $command = new $class();
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

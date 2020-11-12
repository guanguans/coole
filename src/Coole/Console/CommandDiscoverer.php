<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console;

use Symfony\Component\Finder\Finder;
use Throwable;

class CommandDiscoverer
{
    protected $dir;

    protected $namespace;

    protected $suffix;

    public function __construct(string $dir, string $namespace, string $suffix = '*Command.php')
    {
        $this->dir = $dir;
        $this->namespace = $namespace;
        $this->suffix = $suffix;
    }

    public function getCommands()
    {
        $files = Finder::create()->files()->in($this->dir)->name($this->suffix);

        $commands = [];
        try {
            foreach ($files as $file) {
                $class = rtrim($this->namespace.'\\'.$file->getBasename(), '.php');
                $command = new $class();
                $command instanceof Command && $commands[] = $command;
            }
        } catch (Throwable $e) {
            PHP_SAPI === 'cli' && die($e->getMessage());
        }

        return $commands;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    public function setDir(string $dir)
    {
        $this->dir = $dir;

        return $this;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getSuffix(): string
    {
        return $this->suffix;
    }

    public function setSuffix(string $suffix)
    {
        $this->suffix = $suffix;

        return $this;
    }
}

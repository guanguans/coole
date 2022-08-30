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

use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
    /**
     * 名称.
     */
    protected string $name;

    /**
     * 描述.
     */
    protected string $description;

    /**
     * 隐藏.
     */
    protected bool $hidden = false;

    /**
     * 参数.
     */
    protected array $arguments = [];

    /**
     * 选项.
     */
    protected array $options = [];

    public function __construct()
    {
        parent::__construct($this->name);
        $this->setDescription($this->description);
        $this->setHidden($this->hidden);
        $this->specifyParameters();
    }

    /**
     * 添加参数和选项.
     */
    protected function specifyParameters(): void
    {
        foreach ($this->getArguments() as $arguments) {
            call_user_func_array([$this, 'addArgument'], $arguments);
        }

        foreach ($this->getOptions() as $options) {
            call_user_func_array([$this, 'addOption'], $options);
        }
    }

    /**
     * 获取参数.
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * 获取选项.
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}

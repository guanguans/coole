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

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends \Symfony\Component\Console\Command\Command
{
    /**
     * 名称.
     *
     * @var string
     */
    protected $name = '';

    /**
     * 描述.
     *
     * @var string
     */
    protected $description = '';

    /**
     * 隐藏.
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * 输入.
     *
     * @var InputInterface
     */
    protected $input;

    /**
     * 输出.
     *
     * @var OutputInterface
     */
    protected $output;

    /**
     * 参数.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * 选项.
     *
     * @var array
     */
    protected $options = [];

    public function __construct()
    {
        parent::__construct($this->name);

        $this->setDescription($this->description);

        $this->setHidden($this->hidden);

        $this->specifyParameters();
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;

        $this->output = $output;
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

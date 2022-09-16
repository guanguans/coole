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

use Coole\Console\Concerns\InteractsWithIO;
use Coole\Foundation\App;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Command extends SymfonyCommand
{
    use InteractsWithIO;

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
     *
     * @var array<array<mixed>>
     */
    protected array $arguments = [];

    /**
     * 选项.
     *
     * @var array<array<mixed>>
     */
    protected array $options = [];

    /**
     * 输入.
     */
    protected InputInterface $input;

    /**
     * 输出.
     */
    protected SymfonyStyle $output;

    public function __construct(protected App $app)
    {
        parent::__construct($this->name);
        $this->setDescription($this->description);
        $this->setHidden($this->hidden);
        $this->specifyParameters();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $this->app->make(
            SymfonyStyle::class, ['input' => $input, 'output' => $output]
        );

        return parent::run(
            $this->input = $input, $this->output
        );
    }

    /**
     * 添加参数和选项.
     */
    protected function specifyParameters(): void
    {
        foreach ($this->getArguments() as $arguments) {
            $this->addArgument(...$arguments);
        }

        foreach ($this->getOptions() as $options) {
            $this->addOption(...$options);
        }
    }

    /**
     * 获取参数.
     *
     * @return array<array<mixed>>
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * 获取选项.
     *
     * @return array<array<mixed>>
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}

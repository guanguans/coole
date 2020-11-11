<?php

/*
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Coole\Console\Commands;

use Guanguans\Coole\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    protected $name = 'serve';

    protected $description = 'Serve the application on the PHP development server';

    protected $options = [
        ['php', null, InputOption::VALUE_OPTIONAL, 'The php path to serve the application on', 'php'],
        ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on', '127.0.0.1'],
        ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on', 8000],
        ['file', null, InputOption::VALUE_REQUIRED, 'The file to serve the application on', null],
    ];

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output->writeln("<info>Coole development server started:</info> <http://{$this->input->getOption('host')}:{$this->input->getOption('port')}>");

        passthru($this->serverCommand(), $status);

        return parent::SUCCESS;
    }

    protected function serverCommand()
    {
        return sprintf('%s -S %s:%s %s',
            $this->input->getOption('php'),
            $this->input->getOption('host'),
            $this->input->getOption('port'),
            $this->input->getOption('file')
        );
    }
}

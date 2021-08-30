<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/coole.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Coole\Console\Commands;

use Coole\Console\Command;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    protected $name = 'serve';

    protected $description = 'Serve the application on the PHP development server';

    protected $options = [
        ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on', '127.0.0.1'],
        ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on', 8000],
        ['docroot', null, InputOption::VALUE_REQUIRED, 'The docroot to serve the application on', null],
    ];

    protected $tries = 10;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (empty($this->input->getOption('docroot'))) {
            throw new InvalidArgumentException('Please set option of docroot.');
        }

        if (! file_exists($this->input->getOption('docroot'))) {
            throw new InvalidArgumentException(sprintf('Docroot directory not exist.: %s', $this->input->getOption('docroot')));
        }

        $this->output->writeln("<info>Coole development server started:</info> <http://{$this->input->getOption('host')}:{$this->input->getOption('port')}>");

        passthru($this->serverCommand(), $status);
        if ($status && $this->tries > 0) {
            --$this->tries;
            $input->setOption('port', $input->getOption('port') + 1);
            $this->execute($input, $output);
        }

        return parent::SUCCESS;
    }

    protected function serverCommand()
    {
        return sprintf('%s -S %s:%s -t %s',
            PHP_BINARY,
            $this->input->getOption('host'),
            $this->input->getOption('port'),
            $this->input->getOption('docroot'),
        );
    }
}

<?php

declare(strict_types=1);

/**
 * This file is part of Coole.
 *
 * @link     https://github.com/guanguans/coole
 * @contact  guanguans <ityaozm@gmail.com>
 * @license  https://github.com/guanguans/coole/blob/main/LICENSE
 */

namespace Coole\Console\Commands;

use Coole\Console\Command;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{
    protected string $name = 'serve';

    protected string $description = 'Serve the application on the PHP development server.';

    protected function configure(): void
    {
        $this
            ->addOption(
                'host',
                'H',
                InputOption::VALUE_OPTIONAL,
                'The host address to serve the application on',
                '127.0.0.1'
            )
            ->addOption(
                'port',
                'P',
                InputOption::VALUE_OPTIONAL,
                'The port to serve the application on',
                8000
            )
            ->addOption(
                'docroot',
                'D',
                InputOption::VALUE_REQUIRED,
                'The docroot to serve the application on',
            )
            ->addOption(
                'tries',
                'T',
                InputOption::VALUE_OPTIONAL,
                'The tries to serve the application on',
                10
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (empty($input->getOption('docroot'))) {
            throw new InvalidArgumentException('Please set option of docroot.');
        }

        if (! file_exists($input->getOption('docroot'))) {
            throw new InvalidArgumentException(sprintf('Docroot directory not exist.: %s', $input->getOption('docroot')));
        }

        $tries = $input->getOption('tries');

        $this->output->info('Press Ctrl+C to stop the server.');

        passthru($this->serverCommand($input), $status);

        if ($status && $tries > 0) {
            --$tries;
            $input->setOption('port', $input->getOption('port') + 1);
            $this->execute($input, $output);
        }

        return self::SUCCESS;
    }

    protected function serverCommand(InputInterface $input): string
    {
        return sprintf('%s -S %s:%s -t %s',
            PHP_BINARY,
            $input->getOption('host'),
            $input->getOption('port'),
            $input->getOption('docroot'),
        );
    }
}

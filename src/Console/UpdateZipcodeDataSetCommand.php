<?php

namespace Wnx\SwissCantons\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateZipcodeDataSetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('update-zipcode-data-set')
            ->setDescription('Fetch latest dataset from the Swiss Postal service.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('🚧  Fetch dataset');
        $output->writeln('🚧  Transform dataset');
        $output->writeln('🏁  Finished');

        return 0;
    }
}

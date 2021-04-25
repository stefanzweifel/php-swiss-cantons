<?php

namespace Wnx\SwissCantons\Console;

use Symfony\Component\Console\Application as ConsoleApplication;

class Application extends ConsoleApplication
{
    public function __construct()
    {
        parent::__construct('PHP Swiss Cantons', '4.0.0');

        $command = new UpdateZipcodeDatasetCommand();
        $this->add($command);
    }
}

<?php

namespace Hansen\system\CLI\db;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class db extends Command
{
    protected function configure()
    {
        $this
            ->setName("db")
            ->setDescription("Show database configuration");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dbuser = env("DB_USER");
        $dbpassword = env("DB_PASSWORD");
        $dbdriver = env("DB_DRIVER");
        $dbport = env("DB_PORT");
        $dbhost = env("DB_HOST");

        $output->writeln("
[ Database config ]
> Database Driver : $dbdriver
> Database Host : $dbhost
> Database Port : $dbport
> Username : $dbuser
> Password : $dbpassword
        ");

        return 1;
    }
}
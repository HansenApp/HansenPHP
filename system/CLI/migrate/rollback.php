<?php

namespace Hansen\system\CLI\migrate;

use Hansen\system\Database\Migrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class rollback extends Command
{
    protected function configure()
    {
        $this
            ->setName("migrate:rollback")
            ->setDescription("Rollback all migrations");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = new Migrations();
        $db->rollbackMigrations();

        return 1;
    }
}
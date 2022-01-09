<?php

namespace Hansen\system\CLI\migrate;

use Hansen\system\Database\Migrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class migrate extends Command
{
    protected function configure()
    {
        $this
            ->setName("migrate:migrate")
            ->setDescription("Migrating all migrations");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = new Migrations();
        $db->applyMigrations();

        return 1;
    }
}
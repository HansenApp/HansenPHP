<?php

namespace Hansen\system\CLI\migrate;

use Hansen\system\Database\Migrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class fresh extends Command
{
    protected function configure()
    {
        $this
            ->setName("migrate:fresh")
            ->setDescription("Migrating all migrations fresh condition");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = new Migrations();
        $db->rollbackMigrations();
        $db->applyMigrations();

        return 1;
    }
}
<?php

namespace Hansen\system\CLI;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class Serve extends Command
{
    protected function configure()
    {
        $this
            ->setName("serve")
            ->setAliases(["serv"])
            ->setDescription("Running Hansen PHP Server On http://localhost:8000")
            ->addOption("port", "p", InputOption::VALUE_OPTIONAL, "Server port default is 8000", "8000");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = $input->getOption('port');
        $time = date("Y-m-d H:i:s");
        $times = date("[Y-m-d H:i:s]");

        $output->writeln("$times <bg=yellow>COMPILING<bg=default> > Compiling server...");
        sleep(2);
        $output->writeln("$times <bg=bright-green>SUCCESS<bg=default> > Successfully compiling server!");

        $output->writeln("
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
┃ -→ <fg=green>Running HansenPHP server on <options=underscore>http://localhost:8000<options=blink>
┃ -→ <fg=green>Time <fg=white>: $time
┃ -→ <fg=green>Online <fg=white>: <bg=green>True<bg=black>
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
        ");

        passthru("php -S localhost:$port public/index.php");

        return 1;
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message;
    }
}
<?php

namespace Hansen\system\CLI\make;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class model extends Command
{
    protected function configure()
    {
        $this
            ->setName("make:model")
            ->setDescription("Make new model")
            ->addArgument("name", InputArgument::REQUIRED, "Model name");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument("name");
        $helper = $this->getHelper('question');
        $qst = new Question("You use 'Windows PowerShell' ? ", "no");

        $ask = $helper->ask($input, $output, $qst);
        if ($ask === "no") {
            passthru('(echo | set /p="<?php" & echo. & echo. & echo namespace App\Models; & echo. & echo class '.$name.' { & echo. & echo }) > App/Models/' . $name . '.php');
        } elseif ($ask === "yes") {
            echo "Coming Soon";
        } else {
            die;
        }

        return 1;
    }
}
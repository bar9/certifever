<?php

namespace App\Command;


use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(name: 'app:import:symfony')]
class ImportSymfonyQuestionsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $parsed = array_map(
                function($subj){
                    return Yaml::parse(
                        file_get_contents("https://raw.githubusercontent.com/certificationy/symfony-pack/master/data/$subj.yml"
                        ),
                    );
                },[
                    "architecture",
//                    "automated-tests",
//                    "cache-http",
//                    "command-line",
//                    "config",
//                    "controllers",
//                    "dependency-injection",
//                    "forms",
//                    "http",
//                    "misc",
//                    "php",
//                    "process",
//                    "psr",
//                    "routing",
//                    "security",
//                    "standardization",
//                    "validation",
//                    "yaml"
                ]
            );
            return Command::SUCCESS;
        } catch(Exception $e) {
            return Command::FAILURE;
        }
    }

    protected static $defaultDescription = 'Reads in questions from certificationy on github';
}

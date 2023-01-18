<?php

namespace App\Command;


use Bolt\Entity\Content;
use Bolt\Entity\Field;
use Bolt\Factory\ContentFactory;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Console\Helper\ProgressBar;

#[AsCommand(name: 'app:import:symfony')]
class ImportSymfonyQuestionsCommand extends Command
{
    private ContentFactory $contentFactory;
    public static array $subjectsList = [
        "architecture",
                    "automated-tests",
                    "cache-http",
                    "command-line",
                    "config",
                    "controllers",
//                    "dependency-injection", //invalid yaml
                    "forms",
                    "http",
                    "misc",
                    "php",
                    "process",
                    "psr",
                    "routing",
                    "security",
                    "standardization",
                    "validation",
                    "yaml"
    ];

    public function __construct(ContentFactory $contentFactory, string $name = null)
    {
        $this->contentFactory = $contentFactory;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $max = count(self::$subjectsList);
            $progressBar = new ProgressBar($output, $max);
            $progressBar->start();
            $parsed = array_map(
                function($subj) use ($progressBar){
                    $data = Yaml::parse(
                        file_get_contents("https://raw.githubusercontent.com/certificationy/symfony-pack/master/data/$subj.yml"
                        ),
                    );
                    $progressBar->advance();
                    return $data;
                }, self::$subjectsList
            );
            $progressBar->finish();
            $output->writeln("\n");

            foreach ($parsed as $categoryContainer) {
                foreach ($categoryContainer['questions'] as $importModel) {
                    $questionEntity = $this->contentFactory->create('questions');
                    $questionEntity->setFieldValue('question', $importModel['question']);
                    $questionEntity->setFieldValue('help', $importModel['help']);

                    $answersField = new Field\CollectionField();
                    $answersField->setName('answers');
                    $questionEntity->addField($answersField);

                    $sortOrder = 0 ;
                    foreach ($importModel['answers'] as $answer) {
                        $setField = new Field\SetField();
                        $setField->setName('answer');
                        $setField->setSortorder($sortOrder++);
                        $setField->setParent($answersField);
                        $questionEntity->addField($setField);

                        $correctField = new Field\CheckboxField();
                        $correctField->setName('correct');
                        $correctField->setValue($answer['correct']);
                        $correctField->setParent($setField);
                        $questionEntity->addField($correctField);

                        $valueField = new Field\TextField();
                        $valueField->setName('value');
                        $valueField->setValue($answer['value']);
                        $valueField->setParent($setField);
                        $questionEntity->addField($valueField);
                    }

                    $this->contentFactory->save($questionEntity);
                }
            }

            return Command::SUCCESS;
        } catch(Exception $e) {
            return Command::FAILURE;
        }
    }

    protected static $defaultDescription = 'Reads in questions from certificationy on github';
}

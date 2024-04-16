<?php

declare(strict_types=1);

namespace App\Command;

use App\Dto\Aggregator\AggregateRoot;
use App\FileSystem\CsvFile;
use App\Manager\ActionHandlerManager;
use App\Manager\FileDownloadManager;
use App\Serializer\Serializer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:export',
    description: 'Exports the data from the MyFxBook API to a CSV file',
)]
class ExportCommand extends Command
{
    private const TYPES = ['daily_data', 'daily_gain', 'history'];

    public function __construct(
        private readonly ActionHandlerManager $actionHandlerManager,
        private readonly FileDownloadManager $fileDownloadManager,
        private readonly Serializer $serializer
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Exporting the data...');

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $handler = $helper->ask($input, $output, new ChoiceQuestion('Please choose a data type: ', self::TYPES));

        $aggregator = new AggregateRoot();

        $actionHandler = ($this->actionHandlerManager)($handler);
        $actionHandler($aggregator);

        $csvFile = new CsvFile();
        $csvFile->setFileName($handler);
        $csvFile->setContents(
            $this->serializer->encode($aggregator->getData(), 'csv', ['csv_delimiter' => ','])
        );

        ($this->fileDownloadManager)($csvFile);

        $io->success('Finished...');
        return Command::SUCCESS;
    }
}

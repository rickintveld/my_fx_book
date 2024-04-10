<?php

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Dto\Aggregator\DailyDataAggregator;
use App\Presentation\Output\TableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:daily-data',
    description: 'Add a short description for your command',
)]
class DailyDataCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerInterface $dailyDataActionHandler,
        private readonly TableInterface $dailyDataTable
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Daily data for all active accounts!');

        $aggregator = new DailyDataAggregator();

        try {
            ($this->dailyDataActionHandler)($aggregator);
            $this->dailyDataTable->setRows($aggregator->getData())->render($output);
        } catch (\Throwable $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }
}

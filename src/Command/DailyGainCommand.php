<?php

declare(strict_types=1);

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Dto\Aggregator\DailyGainsAggregator;
use App\Presentation\Output\TableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:daily-gain',
    description: 'Daily gain tables for all accounts',
)]
class DailyGainCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerInterface $dailyGainActionHandler,
        private readonly TableInterface $dailyGainTable
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Daily gain for all active accounts.');

        $aggregator = new DailyGainsAggregator();

        try {
            ($this->dailyGainActionHandler)($aggregator);
            $this->dailyGainTable->setRows($aggregator->getData())->render($output);
        } catch (\Throwable $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

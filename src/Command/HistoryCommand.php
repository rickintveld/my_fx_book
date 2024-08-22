<?php

declare(strict_types=1);

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Dto\Aggregator\HistoryAggregator;
use App\Presentation\Output\TableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:history',
    description: 'The position history for every account',
)]
class HistoryCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerInterface $historyActionHandler,
        private readonly TableInterface $historyTable
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('The position history for every account');

        $aggregator = new HistoryAggregator();

        ($this->historyActionHandler)($aggregator);

        $this->historyTable->setRows($aggregator->getData())->render($output);

        return Command::SUCCESS;
    }
}

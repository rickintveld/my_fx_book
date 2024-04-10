<?php

declare(strict_types=1);

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Dto\Aggregator\AggregateRoot;
use App\Presentation\Output\TableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:accounts',
    description: 'Fetch all accounts',
)]
class AccountCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerInterface $accountActionHandler,
        private readonly TableInterface $accountTable
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Overview of all active accounts');

        $aggregator = new AggregateRoot();

        try {
            ($this->accountActionHandler)($aggregator);
            $this->accountTable->setRows($aggregator->getAccounts())->render($output);
        } catch (\Throwable $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

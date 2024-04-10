<?php

declare(strict_types=1);

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Dto\Aggregator\WidgetAggregator;
use App\Presentation\Output\TableInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:widget',
    description: 'Creates a custom chart widget link for each account',
)]
class WidgetCommand extends Command
{
    public function __construct(
        private readonly ActionHandlerInterface $widgetActionHandler,
        private readonly TableInterface $widgetTable
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Building the custom widgets');

        $aggregator = new WidgetAggregator();

        ($this->widgetActionHandler)($aggregator);

        $this->widgetTable->setRows($aggregator->getData())->render($output);

        return Command::SUCCESS;
    }
}

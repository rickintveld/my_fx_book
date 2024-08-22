<?php

declare(strict_types=1);

namespace App\Command;

use App\Action\ActionInterface;
use App\ActionHandler\ActionHandler;
use App\Dto\Aggregator\AggregateRoot;
use App\Strategy\ActionHandlerStrategy;
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
    private const CHOICES = ['daily_data', 'daily_gain', 'history'];

    /**
     * @param array<ActionInterface> $exportActions
     */
    public function __construct(
        private readonly ActionHandlerStrategy $actionHandlerStrategy,
        private readonly array $postHooks
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Exporting the data...');

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $handler = $helper->ask($input, $output, new ChoiceQuestion('Please choose a data type: ', self::CHOICES));

        $aggregator = new AggregateRoot();

        /** @var ActionHandler $actionHandler */
        $actionHandler = ($this->actionHandlerStrategy)($handler);

        foreach ($this->postHooks as $action) {
            $actionHandler->postHook($action);
        }

        $actionHandler($aggregator);

        $io->success('Finished downloading the data...');

        return Command::SUCCESS;
    }
}

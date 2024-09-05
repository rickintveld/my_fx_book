<?php

namespace App\Command;

use App\ActionHandler\ActionHandlerInterface;
use App\Contract\Repository\UserRepositoryInterface;
use App\Dto\Aggregator\AggregateRoot;
use App\Manager\MyFxBookManager;
use App\Presentation\Output\TableInterface;
use App\Strategy\StrategyManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'fx:account-data',
    description: 'Fetch the chosen type of data for a single account.',
)]
class AccountDataCommand extends Command
{
    private const DATA_TYPES = ['daily_data', 'daily_gain', 'history'];

    /**
     * @param StrategyManagerInterface<ActionHandlerInterface> $actionHandlerStrategy
     * @param StrategyManagerInterface<ActionHandlerInterface> $tableStrategy
     */
    public function __construct(
        private readonly MyFxBookManager $myFxBookManager,
        private readonly UserRepositoryInterface $userRepository,
        private readonly StrategyManagerInterface $actionHandlerStrategy,
        private readonly StrategyManagerInterface $tableStrategy,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = $this->userRepository->findLatest();

        if (is_null($user)) {
            $io->error('No user found!');
            return Command::FAILURE;
        }

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $account = $helper->ask($input, $output, new ChoiceQuestion('Select an account ID', $this->myFxBookManager->accountIds($user)));
        $dataType = $helper->ask($input, $output, new ChoiceQuestion('Please choose a data type: ', self::DATA_TYPES));

        $aggregator = new AggregateRoot();
        $aggregator->setSession($user->getSession() ?? '');
        $aggregator->setAccounts([$account]);

        /** @var ActionHandlerInterface $actionHandler */
        $actionHandler = ($this->actionHandlerStrategy)($dataType);
        $actionHandler($aggregator);

        /** @var TableInterface $table */
        $table = ($this->tableStrategy)($dataType);
        $table->setRows($aggregator->getData())->render($output);

        return Command::SUCCESS;
    }
}

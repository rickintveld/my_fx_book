<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Event\CreateAccountEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final readonly class FetchTradingAccounts implements ActionInterface
{
    public function __construct(
        private EventDispatcherInterface $eventBus,
        private MyFxBookRepositoryInterface $myFxBookRepository
    ) {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $accounts = $this->myFxBookRepository->accounts($aggregator->getSession());

        if (count($accounts) === 0) {
            throw new \Exception('No accounts found');
        }

        foreach ($accounts as $account) {
            $this->eventBus->dispatch(new CreateAccountEvent($account));
        }

        $aggregator->setAccounts($accounts);
    }
}

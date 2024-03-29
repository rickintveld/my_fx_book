<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Event\UpdateAccountEvent;
use App\Repository\AccountRepository;
use App\Repository\Api\MyFxBookRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FetchAccounts implements ActionInterface
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly EventDispatcherInterface $eventBus,
        private readonly MyFxBookRepository $myFxBookRepository
    ) {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {   
        $accounts = $this->accountRepository->findAll();

        $myFxBookAccounts = $this->myFxBookRepository->accounts($aggregator->getSession());

        if (null === $myFxBookAccounts) {
            throw new \Exception('No accounts found!');
        }

        $aggregator->setAccounts($accounts);

        foreach ($accounts as $account) {
            $keys = array_keys(array_column($myFxBookAccounts, 'accountId'), $account->getAccountId());
            
            if (count($keys) > 0) {
                $this->eventBus->dispatch(new UpdateAccountEvent($account, $myFxBookAccounts[array_shift($keys)]));
            }
        }
    }
}
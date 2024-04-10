<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Event\CreateAccountEvent;
use App\Event\UpdateAccountEvent;
use App\Repository\AccountRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FetchAccounts implements ActionInterface
{
    public function __construct(
        private readonly AccountRepository $accountRepository,
        private readonly EventDispatcherInterface $eventBus,
        private readonly MyFxBookRepositoryInterface $myFxBookRepository
    ) {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $myFxBookAccounts = $this->myFxBookRepository->accounts($aggregator->getSession());

        if (count($myFxBookAccounts) > 0) {
            array_map(fn ($account) => $this->eventBus->dispatch(new CreateAccountEvent($account)), $myFxBookAccounts);
        }

        if (null === $myFxBookAccounts) {
            throw new \Exception('No accounts found!');
        }

        $accounts = $this->accountRepository->findAll();

        foreach ($accounts as $account) {
            $keys = array_keys(array_column($myFxBookAccounts, 'accountId'), $account->getAccountId());

            if (count($keys) > 0) {
                $key = array_shift($keys);
                $this->eventBus->dispatch(new UpdateAccountEvent($account, $myFxBookAccounts[$key]));

                unset($myFxBookAccounts[$key]);
                $myFxBookAccounts = array_values($myFxBookAccounts);
            }
        }

        $aggregator->setAccounts($accounts);
    }
}

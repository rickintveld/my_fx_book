<?php

namespace App\Tests\Action\Account;

use App\Action\Account\FetchAccounts;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateRoot;
use App\Entity\Account;
use App\Event\CreateAccountEvent;
use App\Event\UpdateAccountEvent;
use App\Repository\AccountRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class FetchAccountsTest extends TestCase
{
    public function testAction(): void
    {
        $account = $this->createMock(Account::class);
        $account->method('getAccountId')->willReturn(1);

        $accountRepository = $this->getMockBuilder(AccountRepository::class)->disableOriginalConstructor()->getMock();
        $accountRepository->expects($this->once())->method('findAll')->willReturn([$account]);

        $eventBus = $this->getMockBuilder(EventDispatcherInterface::class)->disableOriginalConstructor()->getMock();
        $eventBus->expects($this->exactly(3))->method('dispatch')->with($this->callback(function ($object) {
            if ($object instanceof CreateAccountEvent) {
                return true;
            }
            if ($object instanceof UpdateAccountEvent) {
                return true;
            }

            return false;
        }));

        $myFxBookRepository = $this->getMockBuilder(MyFxBookRepositoryInterface::class)->disableOriginalConstructor()->getMock();
        $myFxBookRepository->expects($this->once())->method('accounts')->with('123abc#')->willReturn([['accountId' => 1], ['accountId' => 2]]);

        /**
         * @var AccountRepository $accountRepository
         * @var EventDispatcherInterface $eventBus
         * @var MyFxBookRepositoryInterface $myFxBookRepository
         */
        $fetchAccounts = new FetchAccounts($accountRepository, $eventBus, $myFxBookRepository);

        $aggregator = new AggregateRoot();
        $aggregator->setSession('123abc#');

        $fetchAccounts($aggregator);

        $this->assertNotEmpty($aggregator->getAccounts());
    }
}

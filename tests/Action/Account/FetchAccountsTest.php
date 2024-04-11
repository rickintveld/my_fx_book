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
        $eventBus->expects($this->once())->method('dispatch')->with(new CreateAccountEvent(['accountId' => 1]));
        $eventBus->expects($this->once())->method('dispatch')->with(new UpdateAccountEvent($account, ['accountId' => 1]));

        $myFxBookRepository = $this->getMockBuilder(MyFxBookRepositoryInterface::class)->disableOriginalConstructor()->getMock();
        $myFxBookRepository->expects($this->once())->method('accounts')->with('123abc#')->willReturn([['accountId' => 1], ['accountId' => 2]]);

        $fetchAccounts = new FetchAccounts($accountRepository, $eventBus, $myFxBookRepository);

        $aggregator = new AggregateRoot();
        $aggregator->setSession('123abc#');

        $fetchAccounts($aggregator);

        $this->assertNotEmpty($aggregator->getAccounts());
    }
}

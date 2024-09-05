<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Contract\Repository\AccountRepositoryInterface;
use App\Entity\Account;
use App\Event\CreateAccountEvent;
use App\Event\UpdateAccountEvent;
use App\Serializer\Serializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

#[AsEventListener()]
class CreateAccountEventListener
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly EventDispatcherInterface $eventBus,
        private readonly Serializer $serializer
    ) {}

    public function __invoke(CreateAccountEvent $event): void
    {
        $account = $this->accountRepository->findOneBy(['accountId' => $event->account['accountId']]);

        if (null !== $account && is_a($account, Account::class)) {
            $this->eventBus->dispatch(new UpdateAccountEvent($account, $event->account));
            return;
        }

        $account = $this->serializer->deserialize(json_encode($event->account), Account::class, 'json');

        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }
}

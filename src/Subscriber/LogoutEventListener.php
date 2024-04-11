<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Event\LogoutEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
final class LogoutEventListener
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MyFxBookRepositoryInterface $myFxBookRepository,
    ) {
    }

    public function __invoke(LogoutEvent $event): void
    {
        if (null === $event->user->getSession()) {
            throw new \Exception('A session is required to logout!');
        }

        $this->myFxBookRepository->logout($event->user->getSession());

        $this->entityManager->remove($event->user);
        $this->entityManager->flush();
    }
}

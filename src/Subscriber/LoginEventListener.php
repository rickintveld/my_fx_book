<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Entity\User;
use App\Event\LoginEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
final class LoginEventListener 
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MyFxBookRepositoryInterface $myFxBookRepository
    ) {
    }

    public function __invoke(LoginEvent $event): void
    {
        $session = $this->myFxBookRepository->login(
            $event->loginCredentials->getEmail(), 
            $event->loginCredentials->getPassword()
        );

        $user = new User();
        $user->setEmail($event->loginCredentials->getEmail());
        $user->setPassword($event->loginCredentials->getPassword());
        $user->setSession($session->token);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
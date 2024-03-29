<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Entity\Account;
use App\Event\UpdateAccountEvent;
use App\Serializer\Serializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

#[AsEventListener()]
class UpdateAccountEventListener
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Serializer $serializer
    ) {
    }

    public function __invoke(UpdateAccountEvent $event)
    {
        $this->serializer->deserialize(
            json_encode($event->accountData),
            Account::class, 
            'json', 
            [AbstractNormalizer::OBJECT_TO_POPULATE => $event->account]
        );

        $this->entityManager->flush();
    }
}
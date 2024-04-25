<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Exception\SessionNotFoundException;
use App\Repository\UserRepository;

final readonly class FetchUserSession implements ActionInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $user = $this->userRepository->findLatest();

        if (null === $user || null === $user->getSession()) {
            throw new SessionNotFoundException();
        }

        $aggregator->setSession($user->getSession());
    }
}

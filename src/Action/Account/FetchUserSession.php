<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Contract\Repository\UserRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Exception\SessionNotFoundException;

final readonly class FetchUserSession implements ActionInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function __invoke(AggregateInterface $aggregator): void
    {
        $user = $this->userRepository->findLatest();


        if (null === $user || null === $user->getSession()) {
            throw new SessionNotFoundException();
        }

        $aggregator->setSession($user->getSession());
    }
}

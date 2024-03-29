<?php

declare(strict_types=1);

namespace App\Action\Account;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Repository\UserRepository;

class FetchUserSession implements ActionInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $user = $this->userRepository->findLatest();

        if (null === $user) {
            throw new \Exception('Could not find a user session');
        }

        $aggregator->setSession($user->getSession());
    }
}
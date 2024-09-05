<?php

declare(strict_types=1);

namespace App\Manager;

use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Entity\User;

class MyFxBookManager
{
    public function __construct(
        private readonly MyFxBookRepositoryInterface $myFxBookRepository
    ) {}

    /**
     * @return array<int>
     */
    public function accountIds(User $user): array
    {
        $accounts = $this->myFxBookRepository->accounts($user->getSession() ?? '');

        return array_map(static fn($a) => $a['id'], $accounts);
    }
}

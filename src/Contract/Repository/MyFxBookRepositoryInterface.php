<?php

declare(strict_types=1);

namespace App\Contract\Repository;

use App\ValueObject\Session;

interface MyFxBookRepositoryInterface
{
    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function accounts(string $session): array;

    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function dailyData(string $session, int $accountId): array;

    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function dailyGains(string $session, int $accountId): array;

    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function history(string $session, int $accountId): array;

    /**
     * @throws \Exception
     */
    public function login(string $email, string $password): Session;

    /**
     * @throws \Exception
     */
    public function logout(string $session): void;

    /**
     * @throws \Exception
     */
    public function chartWidget(string $session, int $accountId): string;
}

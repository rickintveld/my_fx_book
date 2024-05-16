<?php

declare(strict_types=1);

namespace App\Contract\Repository;

use App\Exception\MyFxBookRequestException;
use App\ValueObject\Session;

interface MyFxBookRepositoryInterface
{
    /**
     * @return array<mixed>
     * @throws MyFxBookRequestException
     */
    public function accounts(string $session): array;

    /**
     * @return array<mixed>
     * @throws MyFxBookRequestException
     */
    public function dailyData(string $session, int $accountId): array;

    /**
     * @return array<mixed>
     * @throws MyFxBookRequestException
     */
    public function dailyGains(string $session, int $accountId): array;

    /**
     * @return array<mixed>
     * @throws MyFxBookRequestException
     */
    public function history(string $session, int $accountId): array;

    /**
     * @throws MyFxBookRequestException
     */
    public function login(string $email, string $password): Session;

    /**
     * @throws MyFxBookRequestException
     */
    public function logout(string $session): void;

    /**
     * @throws MyFxBookRequestException
     */
    public function chartWidget(string $session, int $accountId): string;
}

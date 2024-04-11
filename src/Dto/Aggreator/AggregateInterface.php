<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

interface AggregateInterface
{
    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function getAccounts(): array;

    /**
     * @param array<mixed> $accounts
     */
    public function setAccounts(array $accounts): void;

    /**
     * @return array<mixed>
     * @throws \Exception
     */
    public function getData(): array;

    /**
     * @param array<mixed> $data
     */
    public function setData(array $data): void;

    /**
     * @throws \Exception
     */
    public function getSession(): string;

    public function setSession(string $session): void;
}

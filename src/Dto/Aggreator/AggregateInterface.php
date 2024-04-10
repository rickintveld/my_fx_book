<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

interface AggregateInterface
{
    /**
     * @throws \Exception
     */
    public function getAccounts(): array;

    public function setAccounts(array $accounts): void;

    /**
     * @throws \Exception
     */
    public function getData(): array;

    public function setData(array $data): void;

    /**
     * @throws \Exception
     */
    public function getSession(): string;

    public function setSession(string $session): void;
}

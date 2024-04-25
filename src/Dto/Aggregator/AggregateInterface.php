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
     * @return mixed
     * @throws \Exception
     */
    public function getData(): mixed;

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void;

    /**
     * @throws \Exception
     */
    public function getSession(): string;

    public function setSession(string $session): void;
}

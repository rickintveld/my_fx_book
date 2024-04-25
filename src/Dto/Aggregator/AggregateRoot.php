<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

class AggregateRoot implements AggregateInterface
{
    /** @var array<mixed> */
    private array $accounts = [];

    /** @var mixed */
    private mixed $data = null;

    private ?string $session;

    public function setAccounts(array $accounts): void
    {
        $this->accounts = $accounts;
    }

    public function getAccounts(): array
    {
        if (empty($this->accounts)) {
            throw new \Exception('No accounts found!');
        }

        return $this->accounts;
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function getData(): mixed
    {
        if ($this->data === null) {
            throw new \Exception('No data found!');
        }

        return $this->data;
    }

    public function setSession(string $session): void
    {
        $this->session = $session;
    }

    public function getSession(): string
    {
        if (null === $this->session) {
            throw new \Exception('The session is missing');
        }

        return $this->session;
    }
}

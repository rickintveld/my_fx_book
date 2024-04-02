<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

class AggregateRoot implements AggregateInterface
{
    private array $accounts = [];
    private array $data = [];
    private ?string $session;

    public function setAccounts(array $accounts): void
    {
        $this->accounts = $accounts;
    }
    
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
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
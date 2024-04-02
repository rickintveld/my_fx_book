<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

interface AggregateInterface 
{
    public function setAccounts(array $accounts): void;
    
    public function getAccounts(): array;

    public function getData(): array;

    public function setData(array $data): void;

    public function setSession(string $session): void;

    public function getSession(): string;
}
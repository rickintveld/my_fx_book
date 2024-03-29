<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

class DailyGainsAggregator extends AggregateRoot
{
    private array $dailyGains = [];

    public function setDailyGains(array $dailyGains): void
    {
        $this->dailyGains = $dailyGains;
    }

    public function getDailyGains(): array
    {
        return $this->dailyGains;
    }
}
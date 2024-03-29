<?php

declare(strict_types=1);

namespace App\Dto\Aggregator;

class DailyDataAggregator extends AggregateRoot
{
    protected array $dailyData = [];

    public function setDailyData(array $data): void
    {
        $this->dailyData = $data;
    }

    public function getDailyData(): array
    {
        return $this->dailyData;
    }
}
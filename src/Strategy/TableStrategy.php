<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Exception\ClassNotFoundException;
use App\Presentation\Output\TableInterface;

/**
 * @implements StrategyManagerInterface<TableInterface>
 */
class TableStrategy implements StrategyManagerInterface
{
    public function __construct(
        private readonly TableInterface $dailyDataTable,
        private readonly TableInterface $dailyGainTable,
        private readonly TableInterface $historyTable
    ) {}

    public function __invoke(string $strategy): TableInterface
    {
        return match ($strategy) {
            'daily_data' => $this->dailyDataTable,
            'daily_gain' => $this->dailyGainTable,
            'history' => $this->historyTable,
            default => throw new ClassNotFoundException($strategy),
        };
    }
}

<?php

declare(strict_types=1);

namespace App\Strategy;

use App\ActionHandler\ActionHandlerInterface;
use App\Exception\ClassNotFoundException;

/**
 * @implements StrategyManagerInterface<ActionHandlerInterface>
 */
class ActionHandlerStrategy implements StrategyManagerInterface
{
    public function __construct(
        private readonly ActionHandlerInterface $dailyDataActionHandler,
        private readonly ActionHandlerInterface $dailyGainActionHandler,
        private readonly ActionHandlerInterface $historyActionHandler
    ) {}

    public function __invoke(string $strategy): ActionHandlerInterface
    {
        return match ($strategy) {
            'daily_data' => $this->dailyDataActionHandler,
            'daily_gain' => $this->dailyGainActionHandler,
            'history' => $this->historyActionHandler,
            default => throw new ClassNotFoundException($strategy),
        };
    }
}

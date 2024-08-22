<?php

declare(strict_types=1);

namespace App\Strategy;

use App\ActionHandler\ActionHandlerInterface;
use App\Exception\ClassNotFoundException;

class ActionHandlerStrategy
{
    public function __construct(
        private readonly ActionHandlerInterface $dailyDataActionHandler,
        private readonly ActionHandlerInterface $dailyGainActionHandler,
        private readonly ActionHandlerInterface $historyActionHandler
    ) {}

    public function __invoke(string $handler): ActionHandlerInterface
    {
        return match ($handler) {
            'daily_data' => $this->dailyDataActionHandler,
            'daily_gain' => $this->dailyGainActionHandler,
            'history' => $this->historyActionHandler,
            default => throw new ClassNotFoundException($handler),
        };
    }
}

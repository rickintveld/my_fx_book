<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Dto\Aggregator\AggregateInterface;

interface ActionHandlerInterface
{
    public function __invoke(AggregateInterface $aggregate): void;
}

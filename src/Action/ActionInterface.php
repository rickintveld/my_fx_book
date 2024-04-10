<?php

declare(strict_types=1);

namespace App\Action;

use App\Dto\Aggregator\AggregateInterface;

interface ActionInterface
{
    public function __invoke(AggregateInterface $aggregator): void;
}

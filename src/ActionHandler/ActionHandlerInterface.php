<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;

interface ActionHandlerInterface
{
    public function __invoke(AggregateInterface $aggregate): void;

    public function preHook(ActionInterface $action): void;

    public function postHook(ActionInterface $action): void;
}

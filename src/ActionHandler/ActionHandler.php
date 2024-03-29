<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Dto\Aggregator\AggregateInterface;
use Psr\Log\LoggerInterface;

abstract class ActionHandler implements ActionHandlerInterface
{
    public function __construct(
        private readonly iterable $actions,
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke(AggregateInterface $aggregate): void
    {
        foreach ($this->actions as $action) {
            try {
                $action($aggregate);
            } catch (\Throwable $t) {
                $this->logger->error($t->getMessage());
                break;
            }
        }
    }
}
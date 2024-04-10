<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Action\ActionInterface;
use App\Contract\Strategy\CircuitBreakerInterface;
use App\Dto\Aggregator\AggregateInterface;
use Psr\Log\LoggerInterface;

abstract class ActionHandler implements ActionHandlerInterface
{
    /**
     * @param iterable<ActionInterface> $actions
     */
    public function __construct(
        private readonly iterable $actions,
        private readonly CircuitBreakerInterface $circuitBreaker,
        private readonly LoggerInterface $logger
    ) {
    }

    public function __invoke(AggregateInterface $aggregate): void
    {
        foreach ($this->actions as $action) {
            $this->logger->info(sprintf('Executing: %s', get_class($action)));

            $this->circuitBreaker->execute(fn () => $action($aggregate));
        }
    }
}

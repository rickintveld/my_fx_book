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
     * @param array<ActionInterface> $actions
     */
    public function __construct(
        private array $actions,
        private readonly CircuitBreakerInterface $circuitBreaker,
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(AggregateInterface $aggregate): void
    {
        foreach ($this->actions as $action) {
            $this->logger->info(sprintf('Executing: %s', get_class($action)));

            $this->circuitBreaker->execute(fn() => $action($aggregate));
        }
    }

    public function preHook(ActionInterface $action): void
    {
        array_unshift($this->actions, $action);
    }

    public function postHook(ActionInterface $action): void
    {
        array_push($this->actions, $action);
    }
}

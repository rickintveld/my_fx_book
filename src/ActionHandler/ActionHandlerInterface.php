<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use Psr\Log\LoggerInterface;

interface ActionHandlerInterface
{
    /**
     * @param iterable<ActionInterface> $actions
     */
    public function __construct(iterable $actions,LoggerInterface $logger);

    public function __invoke(AggregateInterface $aggregate): void;
}
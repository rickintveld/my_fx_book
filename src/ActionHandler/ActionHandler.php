<?php

declare(strict_types=1);

namespace App\ActionHandler;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

abstract class ActionHandler implements ActionHandlerInterface
{
    /**
     * @param iterable<ActionInterface> $actions
     */
    public function __construct(
        private readonly iterable $actions,
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function __invoke(AggregateInterface $aggregate): void
    {
        $this->entityManager->getConnection()->beginTransaction();
    
        foreach ($this->actions as $action) {
            try {
                $this->logger->info(sprintf('Executing: %s', get_class($action)));
                $action($aggregate);
            } catch (\Throwable $t) {
                $this->logger->error($t->getMessage());
                $this->entityManager->getConnection()->rollback();
                break;
            }
        }

        $this->entityManager->getConnection()->close();
    }
}
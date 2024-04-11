<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;

class History implements ActionInterface
{
    public function __construct(private readonly MyFxBookRepositoryInterface $myFxBookRepository)
    {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $history = [];

        foreach ($aggregator->getAccounts() as $account) {
            $history[$account['id']] = $this->myFxBookRepository->history($aggregator->getSession(), $account['id']);
        }

        $aggregator->setData($history);
    }
}

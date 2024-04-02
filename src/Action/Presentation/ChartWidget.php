<?php

declare(strict_types=1);

namespace App\Action\Presentation;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;

class ChartWidget implements ActionInterface
{
    public function __construct(private readonly MyFxBookRepositoryInterface $myFxBookRepository)
    {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $chartWidgets = [];

        foreach ($aggregator->getAccounts() as $account) {
            $chartWidgets[] = $this->myFxBookRepository->chartWidget($aggregator->getSession(), $account['id']);
        }

        $aggregator->setData($chartWidgets);
    }
}
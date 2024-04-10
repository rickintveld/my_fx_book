<?php

declare(strict_types=1);

namespace App\Action\Gain;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Dto\Aggregator\DailyDataAggregator;

class FetchDailyData implements ActionInterface
{
    public function __construct(private readonly MyFxBookRepositoryInterface $myFxBookRepository)
    {
    }

    /**
     * @param DailyDataAggregator $aggregator
     */
    public function __invoke(AggregateInterface $aggregator): void
    {
        $dailyData = [];

        foreach ($aggregator->getAccounts() as $account) {
            $dailyData = array_merge($dailyData, ...$this->myFxBookRepository->dailyData($aggregator->getSession(), $account['id']));
        }

        $aggregator->setData($dailyData);
    }
}

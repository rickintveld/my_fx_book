<?php

declare(strict_types=1);

namespace App\Action\Gain;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Dto\Aggregator\DailyDataAggregator;
use App\Repository\Api\MyFxBookRepository;

class FetchDailyData implements ActionInterface
{
    public function __construct(private readonly MyFxBookRepository $myFxBookRepository)
    {
    }

    /**
     * @param DailyDataAggregator $aggregator
     */
    public function __invoke(AggregateInterface $aggregator): void
    {
        if (in_array(null, [$aggregator->getSession(), $aggregator->getAccounts()])) {
            throw new \Exception('Missing session and or accounts');
        }

        $dailyData = [];

        foreach ($aggregator->getAccounts() as $account) {
            $dailyData = array_merge($dailyData, ...$this->myFxBookRepository->dailyData($aggregator->getSession(), $account['id']));
        }

        $aggregator->setDailyData($dailyData);
    }
}
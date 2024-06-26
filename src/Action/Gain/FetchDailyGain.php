<?php

declare(strict_types=1);

namespace App\Action\Gain;

use App\Action\ActionInterface;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Dto\Aggregator\DailyGainsAggregator;

final readonly class FetchDailyGain implements ActionInterface
{
    public function __construct(private MyFxBookRepositoryInterface $myFxBookRepository)
    {
    }

    /**
     * @param DailyGainsAggregator $aggregator
     */
    public function __invoke(AggregateInterface $aggregator): void
    {
        $dailyGains = [];

        foreach ($aggregator->getAccounts() as $account) {
            $dailyGains = array_merge($dailyGains, ...$this->myFxBookRepository->dailyGains($aggregator->getSession(), $account['id']));
        }

        $aggregator->setData($dailyGains);
    }
}

<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use App\Entity\Account;

class AccountTable extends Table
{
    public function getHeaders(): array
    {
        return [
            'name',
            'gain',
            'daily',
            'monthly',
            'withdrawals',
            'profit',
            'commission',
            'profit factor',
            'pips',
            'started at'
        ];
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows(array $rows): self
    {
        foreach ($rows as $row) {
            /** @var Account $row */
            $this->rows[] = [
                'name' => $row->getName(),
                'gain' => $row->getGain(),
                'daily' => $row->getDaily(),
                'monthly' => $row->getMonthly(),
                'withdrawals' => $row->getWithdrawals(),
                'profit' => $row->getProfit(),
                'commission' => $row->getCommission(),
                'profit factor' => $row->getProfitFactor(),
                'pips' => $row->getPips(),
                'startedAt' => $row->getFirstTradeDate()->format('d-m-Y')
            ];
        }

        return $this;
    }
}

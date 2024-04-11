<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use Symfony\Component\Console\Helper\TableSeparator;

class HistoryTable extends Table
{
    /**
     * @return array<string>
     */
    public function getHeaders(): array
    {
        return ['Symbol', 'Lots', 'Open', 'Close', 'TP', 'SL', 'Pips', 'Profit'];
    }

    /**
     * @param array<mixed> $rows
     */
    public function setRows(array $rows): self
    {
        $iterator = 0;
        $numberOfRows = count($rows);

        foreach ($rows as $accountHistory) {
            $positions = array_filter($accountHistory, fn ($history) => 'Deposit' !== $history['action']);

            $positions = array_map(fn ($position) => [
                'symbol' => $position['symbol'],
                'lots' => $position['sizing']['value'],
                'open' => $position['openPrice'],
                'close' => $position['closePrice'],
                'tp' => $position['tp'],
                'sl' => $position['sl'],
                'pips' => $position['pips'],
                'profit' => $position['profit'],
            ], $positions);

            $this->rows = array_merge($this->rows, $positions);

            $iterator++;

            if ($numberOfRows !== $iterator) {
                $this->rows[] = new TableSeparator();
            }
        }

        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}

<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use Symfony\Component\Console\Helper\TableSeparator;

class DailyGainsTable extends Table
{
    public function getHeaders(): array
    {
        return ['Date', 'RRR', 'Profit'];
    }

    public function setRows(array $rows): self
    {
        $previousMonth = 1;

        $rows = new \ArrayObject($rows);
        $iterator = $rows->getIterator();

        while($iterator->valid()) {
            $month = (int) (new \DateTime($iterator->current()['date']))->format('m');

            if ($iterator->key() === 0) {
                $previousMonth = $month;
            }

            if ($previousMonth < $month) {
                $previousMonth = $month;
                $this->rows[] = new TableSeparator();
            }

            $this->rows[] = $iterator->current();
            
            $iterator->next();
        }

        return $this;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}
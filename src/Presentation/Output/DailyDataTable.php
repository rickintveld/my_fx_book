<?php

declare(strict_types=1);

namespace App\Presentation\Output;

class DailyDataTable extends Table
{
    public function getHeaders(): array
    {
        return [
            'Date',
            'Balance',
            'Pips',
            'Lots',
            'Floating P&L',
            'Profit',
            'Growth equity',
            'Floating pips',
        ];
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows(array $rows): self
    {
        $this->rows = $rows;

        return $this;
    }
}
<?php

declare(strict_types=1);

namespace App\Presentation\Output;

class DailyDataTable extends Table
{
    /**
     * @return array<string>
     */
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

    /**
     * @return array<mixed>
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array<mixed> $rows
     */
    public function setRows(array $rows): self
    {
        $this->rows = $rows;

        return $this;
    }
}

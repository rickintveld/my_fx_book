<?php

declare(strict_types=1);

namespace App\Presentation\Output;

class WidgetTable extends Table
{
    public function getHeaders(): array
    {
        return [
            'Chart widget'
        ];
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows(array $rows): self
    {
        $this->rows = array_map(fn ($row) => is_string($row) ? [$row] : $row, $rows);

        return $this;
    }
}

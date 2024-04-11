<?php

declare(strict_types=1);

namespace App\Presentation\Output;

class WidgetTable extends Table
{
    /**
     * @return array<string>
     */
    public function getHeaders(): array
    {
        return [
            'Chart widget'
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
        $this->rows = array_map(fn ($row) => is_string($row) ? [$row] : $row, $rows);

        return $this;
    }
}

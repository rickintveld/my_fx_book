<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use Symfony\Component\Console\Helper\Table as ConsoleTable;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Table implements TableInterface
{
    protected array $rows = [];

    public function render(OutputInterface $output): void
    {
        $table = new ConsoleTable($output);

        $table->setHeaders($this->getHeaders())->setRows($this->getRows());

        $table->render();
    }

    public abstract function getHeaders(): array;

    public abstract function getRows(): array;
}

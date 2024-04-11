<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use Symfony\Component\Console\Helper\Table as ConsoleTable;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Table implements TableInterface
{
    /** @var array<mixed> */
    protected array $rows = [];

    public function render(OutputInterface $output): void
    {
        $table = new ConsoleTable($output);

        $table->setHeaders($this->getHeaders())->setRows($this->getRows());

        $table->render();
    }

    /**
     * @return array<string>
     */
    public abstract function getHeaders(): array;

    /**
     * @return array<mixed>
     */
    public abstract function getRows(): array;
}

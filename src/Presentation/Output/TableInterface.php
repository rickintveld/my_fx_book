<?php

declare(strict_types=1);

namespace App\Presentation\Output;

use Symfony\Component\Console\Output\OutputInterface;

interface TableInterface
{
    /**
     * @param array<mixed> $rows
     */
    public function setRows(array $rows): self;

    public function render(OutputInterface $output): void;
}

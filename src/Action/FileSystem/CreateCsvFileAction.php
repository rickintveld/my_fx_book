<?php

declare(strict_types=1);

namespace App\Action\FileSystem;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\FileSystem\CsvFile;
use App\Serializer\Serializer;

final readonly class CreateCsvFileAction implements ActionInterface
{
    public function __construct(private Serializer $serializer)
    {
    }

    public function __invoke(AggregateInterface $aggregator): void
    {
        $csvFile = new CsvFile();

        $csvFile->setFileName(sprintf('export_%d', (new \DateTime())->getTimestamp()));

        $csvFile->setContents(
            $this->serializer->encode($aggregator->getData(), 'csv', ['csv_delimiter' => ','])
        );

        $aggregator->setData($csvFile);
    }
}

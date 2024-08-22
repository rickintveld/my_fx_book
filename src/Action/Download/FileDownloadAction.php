<?php

declare(strict_types=1);

namespace App\Action\Download;

use App\Action\ActionInterface;
use App\Dto\Aggregator\AggregateInterface;
use App\Error\InstanceError;
use App\FileSystem\File;
use App\Manager\FileDownloadManager;

final readonly  class FileDownloadAction implements ActionInterface
{
    public function __construct(private FileDownloadManager $fileDownloadManager) {}

    public function __invoke(AggregateInterface $aggregator): void
    {
        if (($aggregator->getData() instanceof File) === false) {
            throw new InstanceError(File::class);
        }

        ($this->fileDownloadManager)($aggregator->getData());
    }
}

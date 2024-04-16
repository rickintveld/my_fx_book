<?php

declare(strict_types=1);

namespace App\Manager;

use App\FileSystem\File;
use Symfony\Component\Filesystem\Filesystem;

class FileDownloadManager
{
    public function __invoke(File $file): void
    {
        $fileSystem = new Filesystem();

        if ($fileSystem->exists($file->getFileName())) {
            $fileSystem->remove($file->getFileName());
        }

        $fileSystem->touch($file->getFileName());

        $fileSystem->appendToFile($file->getFileName(), $file->getContents());
    }
}

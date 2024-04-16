<?php

declare(strict_types=1);

namespace App\FileSystem;

class CsvFile implements File
{
    private const FILE_EXTENSION = 'csv';

    private string $contents;
    private string $fileName;

    /**
     * @throws \Exception
     */
    public function getContents(): string
    {
        return $this->contents;
    }

    public function setContents(string $contents): self
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getFileName(): string
    {
        return sprintf('%s.%s', $this->fileName, self::FILE_EXTENSION);
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }
}

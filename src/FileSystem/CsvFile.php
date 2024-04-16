<?php

declare(strict_types=1);

namespace App\FileSystem;

class CsvFile implements File
{
    private string $contents;
    private string $extension;
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
        return sprintf('%s.%s', $this->fileName, $this->extension);
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getFileExtension(): string
    {
        return $this->extension;
    }

    public function setFileExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }
}

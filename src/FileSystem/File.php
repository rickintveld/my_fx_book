<?php

declare(strict_types=1);

namespace App\FileSystem;

interface File
{
    /**
     * @throws \Exception
     */
    public function getContents(): string;

    public function setContents(string $content): self;

    /**
     * @throws \Exception
     */
    public function getFileName(): string;

    public function setFileName(string $fileName): self;
}

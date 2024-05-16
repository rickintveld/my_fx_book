<?php

declare(strict_types=1);

namespace App\Exception;

class ClassNotFoundException extends \RuntimeException
{
    public function __construct(string $class)
    {
        parent::__construct(sprintf('Class %s not found!', $class));
    }
}

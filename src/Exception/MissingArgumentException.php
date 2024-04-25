<?php

declare(strict_types=1);

namespace App\Exception;

class MissingArgumentException extends \RuntimeException
{
    /**
     * @param string|array<string> $arguments
     */
    public function __construct(array|string $arguments)
    {
        if (is_array($arguments)) {
            $arguments = implode(',', $arguments);
        }

        parent::__construct(sprintf('Missing required arguments %s', $arguments));
    }
}

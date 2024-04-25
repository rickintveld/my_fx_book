<?php

declare(strict_types=1);

namespace App\Error;

class InstanceError extends \TypeError
{
    public function __construct(string $instance)
    {
        parent::__construct(sprintf('Should be an instance of class %s', $instance));
    }
}

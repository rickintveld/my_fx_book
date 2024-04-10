<?php

declare(strict_types=1);

namespace App\Exception;

class CircuitBreakerOpenException extends \Exception
{
    public function __construct()
    {
        parent::__construct('The circuit breaker is open');
    }
}

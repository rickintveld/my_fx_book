<?php

namespace App\Contract\Strategy;

interface CircuitBreakerInterface
{
    public function execute(callable $operation): void;
}

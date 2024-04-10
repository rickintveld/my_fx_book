<?php

declare(strict_types=1);

namespace App\Strategy;

use App\Contract\Strategy\CircuitBreakerInterface;
use App\Enum\CircuitState;
use App\Exception\CircuitBreakerOpenException;

class CircuitBreaker implements CircuitBreakerInterface
{
    private int $failureCount = 0;
    private int $failureThreshold = 3;
    private ?int $lastFailureTime = null;
    private int $resetTimeout = 300;
    private CircuitState $state = CircuitState::CLOSED;

    public function execute(callable $operation): void
    {
        if ($this->state === CircuitState::OPEN && $this->isTimeoutReached()) {
            $this->state = CircuitState::HALF_OPEN;
        }

        if ($this->state === CircuitState::CLOSED || $this->state === CircuitState::HALF_OPEN) {
            try {
                $operation();
                $this->reset();
            } catch (\Exception $e) {
                $this->handleFailure();
                throw $e;
            }
        }

        if ($this->state === CircuitState::OPEN) {
            throw new CircuitBreakerOpenException();
        }
    }

    private function handleFailure(): void
    {
        $this->failureCount++;
        $this->lastFailureTime = time();

        if ($this->failureCount >= $this->failureThreshold) {
            $this->state = CircuitState::OPEN;
        }
    }

    private function isTimeoutReached(): bool
    {
        return time() - $this->lastFailureTime >= $this->resetTimeout;
    }

    private function reset(): void
    {
        $this->failureCount = 0;
        $this->lastFailureTime = null;
        $this->state = CircuitState::CLOSED;
    }
}

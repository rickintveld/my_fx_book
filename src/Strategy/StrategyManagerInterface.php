<?php

declare(strict_types=1);

namespace App\Strategy;

/**
 * @template T of object
 */
interface StrategyManagerInterface
{
    /**
     * @return T
     */
    public function __invoke(string $strategy): object;
}

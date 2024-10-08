<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class CreateAccountEvent extends Event
{
    /**
     * @param array<mixed> $account
     */
    public function __construct(public readonly array $account) {}
}

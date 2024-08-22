<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Account;
use Symfony\Contracts\EventDispatcher\Event;

class UpdateAccountEvent extends Event
{
    /**
     * @param array<mixed> $accountData
     */
    public function __construct(public readonly Account $account, public readonly array $accountData) {}
}

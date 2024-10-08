<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class LogoutEvent extends Event
{
    public function __construct(public readonly User $user) {}
}

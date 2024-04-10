<?php

declare(strict_types=1);

namespace App\Event;

use App\Dto\Account\LoginCredentials;
use Symfony\Contracts\EventDispatcher\Event;

final class LoginEvent extends Event
{
    public function __construct(public readonly LoginCredentials $loginCredentials)
    {
    }
}

<?php

declare(strict_types=1);

namespace App\ValueObject;

readonly class Session
{
    public function __construct(public string $token)
    {
    }
}
<?php

declare(strict_types=1);

namespace App\Builder\Uri;

class UriBuilder 
{
    public function build(string $builder, array $parameters): string
    {
        return match ($builder) {
            'accounts' => (new AccountsUriBuilder())($parameters),
            'dailyData' => (new DailyDataUriBuilder())($parameters),
            'dailyGains' => (new DailyGainsUriBuilder())($parameters),
            'login' => (new LoginUriBuilder())($parameters),
            'logout' => (new LogoutUriBuilder())($parameters),
            default => throw new \Exception('Builder not found!'),
        };
    }
}
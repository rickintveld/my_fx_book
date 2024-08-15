<?php

declare(strict_types=1);

namespace App\Builder\Uri;

use App\Exception\ClassNotFoundException;

class UriBuilder
{
    /**
     * @param array<mixed> $parameters
     */
    public function build(string $builder, array $parameters): string
    {
        
        return match ($builder) {
            'accounts' => (new AccountsUriBuilder())($parameters),
            'dailyData' => (new DailyDataUriBuilder())($parameters),
            'dailyGains' => (new DailyGainsUriBuilder())($parameters),
            'history' => (new HistoryUriBuilder())($parameters),
            'login' => (new LoginUriBuilder())($parameters),
            'logout' => (new LogoutUriBuilder())($parameters),
            'widget' => (new WidgetUriBuilder())($parameters),
            default => throw new ClassNotFoundException($builder),
        };
    }
}

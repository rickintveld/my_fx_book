<?php

declare(strict_types=1);

namespace App\Builder\Uri;

class DailyGainsUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/get-daily-gain.json';

    /**
     * @param array<string, int> $parameters
     */
    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['session'], $parameters['id'])) {
            throw new \Exception('Missing required key session');
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query([
            'session' => $parameters['session'],
            'id' => $parameters['id'],
            'start' => sprintf('%s-01-01', date('Y')),
            'end' => date("Y-m-t"),
        ])));
    }
}

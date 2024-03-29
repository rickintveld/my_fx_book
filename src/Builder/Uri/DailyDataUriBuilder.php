<?php

declare(strict_types=1);

namespace App\Builder\Uri;

class DailyDataUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/get-data-daily.json';

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
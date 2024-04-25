<?php

declare(strict_types=1);

namespace App\Builder\Uri;

use App\Exception\MissingArgumentException;

class HistoryUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/get-history.json';

    /**
     * @param array<string, int> $parameters
     */
    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['session'], $parameters['id'])) {
            throw new MissingArgumentException(['session', 'id']);
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query([
            'session' => $parameters['session'],
            'id' => $parameters['id'],
        ])));
    }
}

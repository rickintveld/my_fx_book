<?php

declare(strict_types=1);

namespace App\Builder\Uri;

class LogoutUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/logout.json';

    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['session'])) {
            throw new \Exception('Missing required key session');
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query(['session' => $parameters['session']])));
    }
}

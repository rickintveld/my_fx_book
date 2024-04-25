<?php

declare(strict_types=1);

namespace App\Builder\Uri;

use App\Exception\MissingArgumentException;

class LogoutUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/logout.json';

    /**
     * @param array<string> $parameters
     */
    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['session'])) {
            throw new MissingArgumentException('session');
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query(['session' => $parameters['session']])));
    }
}

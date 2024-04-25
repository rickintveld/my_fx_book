<?php

declare(strict_types=1);

namespace App\Builder\Uri;

use App\Exception\MissingArgumentException;

class LoginUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/login.json';

    /**
     * @param array<string> $parameters
     */
    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['email'], $parameters['password'])) {
            throw new MissingArgumentException(['email', 'password']);
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query(['email' => $parameters['email'], 'password' => $parameters['password']])));
    }
}

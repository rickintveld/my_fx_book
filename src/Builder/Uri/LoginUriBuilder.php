<?php

declare(strict_types=1);

namespace App\Builder\Uri;

class LoginUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/login.json';

    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['email'], $parameters['password'])) {
            throw new \Exception('Missing required key email or password');
        }
        
        return urldecode(sprintf('%s?%s', self::uri, http_build_query(['email' => $parameters['email'], 'password' => $parameters['password']])));
    }
}
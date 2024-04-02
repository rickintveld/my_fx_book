<?php

declare(strict_types=1);

namespace App\Client;

use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class Client
{
    public function __construct(private HttpClientInterface $client)
    {
        $this->client = $client->withOptions((new HttpOptions())->setBaseUri($this->getBaseUri())->toArray());
    }

    public function get(string $uri): array
    {
        /** @var ResponseInterface $response */
        $response = $this->client->request('GET', $uri);

        return json_decode($response->getContent(), true);
    }

    abstract public function getBaseUri(): string;
}
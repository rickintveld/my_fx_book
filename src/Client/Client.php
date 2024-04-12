<?php

declare(strict_types=1);

namespace App\Client;

use App\Mediator\JsonResponseMediator;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class Client
{
    public function __construct(private HttpClientInterface $client)
    {
        $this->client = $client->withOptions((new HttpOptions())->setBaseUri($this->getBaseUri())->toArray());
    }

    /**
     * @return array<mixed>
     */
    public function get(string $uri): array
    {
        /** @var ResponseInterface $response */
        $response = $this->client->request('GET', $uri);

        return JsonResponseMediator::content($response);
    }

    abstract public function getBaseUri(): string;
}

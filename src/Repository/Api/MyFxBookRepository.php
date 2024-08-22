<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Builder\Uri\UriBuilder;
use App\Client\MyFxBookClient;
use App\Contract\Repository\MyFxBookRepositoryInterface;
use App\Exception\MyFxBookRequestException;
use App\ValueObject\Session;
use Symfony\Component\HttpFoundation\Response;

class MyFxBookRepository implements MyFxBookRepositoryInterface
{
    public function __construct(
        private readonly MyFxBookClient $client,
        private readonly UriBuilder $uriBuilder
    ) {}

    public function accounts(string $session): array
    {
        $response = $this->client->get($this->uriBuilder->build('accounts', ['session' => $session]));

        if (true === $response['error']) {
            throw new MyFxBookRequestException($response['message'], Response::HTTP_BAD_REQUEST);
        }

        return $response['accounts'];
    }

    public function dailyData(string $session, int $accountId): array
    {
        $response = $this->client->get($this->uriBuilder->build('dailyData', ['session' => $session, 'id' => $accountId]));

        if (true === $response['error']) {
            throw new MyFxBookRequestException($response['message'], Response::HTTP_BAD_REQUEST);
        }

        return $response['dataDaily'];
    }

    public function dailyGains(string $session, int $accountId): array
    {
        $response = $this->client->get($this->uriBuilder->build('dailyGains', ['session' => $session, 'id' => $accountId]));

        if (true === $response['error']) {
            throw new MyFxBookRequestException($response['message'], Response::HTTP_BAD_REQUEST);
        }

        return $response['dailyGain'];
    }

    public function history(string $session, int $accountId): array
    {
        $response = $this->client->get($this->uriBuilder->build('history', ['session' => $session, 'id' => $accountId]));

        if (true === $response['error']) {
            throw new MyFxBookRequestException($response['message'], Response::HTTP_BAD_REQUEST);
        }

        return $response['history'];
    }

    public function login(string $email, string $password): Session
    {
        $response = $this->client->get(
            $this->uriBuilder->build('login', ['email' => $email, 'password' => $password])
        );

        if (true === $response['error']) {
            throw new MyFxBookRequestException($response['message'], Response::HTTP_BAD_REQUEST);
        }

        return new Session($response['session']);
    }

    public function logout(string $session): void
    {
        $this->client->get($this->uriBuilder->build('logout', ['session' => $session]));
    }

    public function chartWidget(string $session, int $accountId): string
    {
        return $this->client->getWidgetUri() . $this->uriBuilder->build('widget', ['session' => $session, 'id' => $accountId]);
    }
}

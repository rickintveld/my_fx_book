<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Builder\Uri\UriBuilder;
use App\Client\MyFxBookClient;
use App\ValueObject\Session;

class MyFxBookRepository
{
    public function __construct(
        private readonly MyFxBookClient $client,
        private readonly UriBuilder $uriBuilder
    ) {
    }

    public function accounts(string $session): array
    {
        $response = $this->client->get($this->uriBuilder->build('accounts', ['session' => $session]));

        if (true === $response['error']) {
            throw new \Exception($response['message']);
        }

        return $response['accounts'];
    }

    public function dailyGains(string $session, int $accountId): array
    {
        $response = $this->client->get($this->uriBuilder->build('dailyGains', ['session' => $session, 'id' => $accountId]));

        if (true === $response['error']) {
            throw new \Exception($response['message']);
        }

        return $response['dailyGain'];
    }

    public function login(string $email, string $password): Session
    {
        $response = $this->client->get(
            $this->uriBuilder->build('login', ['email' => $email, 'password' => $password])
        );

        if (true === $response['error']) {
            throw new \Exception($response['message']);
        }

        return new Session($response['session']);
    }

    public function logout(string $session): void
    {
        $this->client->get($this->uriBuilder->build('logout', ['session' => $session]));
    }
}
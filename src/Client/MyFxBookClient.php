<?php

declare(strict_types=1);

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MyFxBookClient extends Client
{
    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client);
    }

    public function getBaseUri(): string
    {
        return 'https://www.myfxbook.com';
    }
}

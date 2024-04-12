<?php

declare(strict_types=1);

namespace App\Mediator;

use Symfony\Contracts\HttpClient\ResponseInterface;

final class JsonResponseMediator
{
    /**
     * @return array<mixed>
     */
    public static function content(ResponseInterface $response): array
    {
        return json_decode($response->getContent(), true);
    }
}

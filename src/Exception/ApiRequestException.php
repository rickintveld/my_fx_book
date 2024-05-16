<?php

declare(strict_types=1);

namespace App\Exception;

class ApiRequestException extends \RuntimeException
{
    public const string API_CLIENT = 'API';

    public function __construct(string $message, int $code = 0)
    {
        parent::__construct(sprintf('[%s][%d] %s', self::API_CLIENT, time(), $message), $code);
    }
}

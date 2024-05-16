<?php

declare(strict_types=1);

namespace App\Exception;

class MyFxBookRequestException extends ApiRequestException
{
    public const string API_CLIENT = 'MyFxBook';
}

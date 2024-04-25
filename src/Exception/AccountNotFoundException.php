<?php

declare(strict_types=1);

namespace App\Exception;

final class AccountNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Account not found!');
    }
}

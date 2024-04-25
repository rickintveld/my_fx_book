<?php

declare(strict_types=1);

namespace App\Exception;

class SessionNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Session not found!');
    }
}

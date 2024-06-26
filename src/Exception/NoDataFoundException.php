<?php

declare(strict_types=1);

namespace App\Exception;

class NoDataFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('No data found!');
    }
}

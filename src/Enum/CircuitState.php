<?php

namespace App\Enum;

enum CircuitState
{
    case CLOSED;
    case HALF_OPEN;
    case OPEN;
}

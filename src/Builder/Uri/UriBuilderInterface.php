<?php

declare(strict_types=1);

namespace App\Builder\Uri;

interface UriBuilderInterface
{
    public function __invoke(array $parameters): string;
}

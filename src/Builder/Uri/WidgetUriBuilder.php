<?php

declare(strict_types=1);

namespace App\Builder\Uri;

use App\Exception\MissingArgumentException;

class WidgetUriBuilder implements UriBuilderInterface
{
    private const uri = '/api/get-custom-widget.png';

    /**
     * @param array<string, int> $parameters
     */
    public function __invoke(array $parameters): string
    {
        if (false === isset($parameters['session'], $parameters['id'])) {
            throw new MissingArgumentException(['session', 'id']);
        }

        return urldecode(sprintf('%s?%s', self::uri, http_build_query([
            'session' => $parameters['session'],
            'id' => $parameters['id'],
            'height' => '200',
            'bart' => '1',
            'linet' => '0',
            'bgColor' => '000000',
            'gridColor' => 'BDBDBD',
            'lineColor' => '00CB05',
            'barColor' => 'FF8D0A',
            'fontColor' => 'FFFFFF',
            'title' => '',
            'titles' => '20',
            'chartbgc' => '474747',
        ])));
    }
}

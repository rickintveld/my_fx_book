<?php

declare(strict_types=1);

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as CoreSerializer;

class Serializer extends CoreSerializer
{
    public function __construct()
    {
        $dateCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            if ($innerObject instanceof \DateTimeInterface) {
                return $innerObject;
            }

            if (is_string($innerObject) && false !== \DateTime::createFromFormat('d/m/Y H:i', $innerObject)) {
                $innerObject = new \DateTime($innerObject);
            }

            return $innerObject;
        };

        $defaultContext = [
            AbstractNormalizer::CALLBACKS => [
                'creationDate' => $dateCallback,
                'firstTradeDate' => $dateCallback,
                'lastUpdateDate' => $dateCallback
            ],
        ];

        $encoders = [new JsonEncoder(), new CsvEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        parent::__construct($normalizers, $encoders);
    }
}

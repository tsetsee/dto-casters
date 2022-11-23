<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\CarbonImmutable;
use Symfony\Component\Serializer\Annotation\Context;
use Tsetsee\DTO\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;
use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;

class ChildDTO extends TseDTO
{
    public int $id;
    #[MapTo('name')]
    public string $title;

    #[Context(normalizationContext: [CarbonNormalizer::FORMAT_KEY => 'Y-m-d H:i:s'])]
    public CarbonImmutable $createdAt;
}

<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\CarbonImmutable;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Tsetsee\DTO\Attributes\MapFrom;
use Tsetsee\DTO\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public int $age;
    public string $name;

    #[MapFrom('register_id')]
    #[MapTo('register_number')]
    public string $registerNumber;

    #[Context(context: [
        DateTimeNormalizer::FORMAT_KEY => 'm-d-Y H:i:s',
    ])]
    public ?\DateTimeImmutable $date = null;

    // public ?CarbonImmutable $date = null;

    public ChildDTO $child;
}

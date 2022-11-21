<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\CarbonImmutable;
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

    public ?CarbonImmutable $date = null;
}

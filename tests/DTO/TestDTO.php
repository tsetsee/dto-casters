<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\Casters\CarbonCaster;
use Tsetsee\DTO\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public string $name;

    #[MapTo('register_number')]
    public string $registerNumber;

    #[MapTo('customer_address')]
    public ?string $customerAddress = null;

    public ?int $age = null;

    #[CastWith(CarbonCaster::class, type: 'timestamp')]
    public Carbon $dateFromTimestamp;

    #[CastWith(CarbonCaster::class, format: 'Y-m-d H:i:s')]
    public ?CarbonImmutable $date = null;

    #[CastWith(CarbonCaster::class, format: 'c')]
    public CarbonImmutable $dateISO;

    #[CastWith(CarbonCaster::class, format: 'c')]
    public ?CarbonImmutable $dateNull = null;
}

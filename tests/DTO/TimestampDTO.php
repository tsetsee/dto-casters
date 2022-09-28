<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;
use Tsetsee\DTO\Casters\CarbonCaster;

class TimestampDTO extends DataTransferObject
{
    #[CastWith(CarbonCaster::class, type: 'timestamp')]
    public Carbon $dateFromTimestamp;
}

<?php

namespace Tsetsee\DtoCasters\Casters;

use Carbon\Carbon;
use DateTimeZone;
use Spatie\DataTransferObject\Caster;

class CarbonCaster implements Caster
{
    /**
     * @param array<mixed>             $types
     * @param string|DateTimeZone|null $tz
     *
     * @phpstan-ignore-next-line
     */
    public function __construct(
        array $types,
        public string $type,
        public string $format = 'Y-m-d H:i:s',
        public $tz = null,
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function cast(mixed $value): mixed
    {
        if ('timestamp' === $this->type) {
            return Carbon::createFromTimestamp(intval($value));
        }

        return Carbon::createFromFormat($this->format, strval($value));
    }
}

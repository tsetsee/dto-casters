<?php

namespace Tsetsee\DtoCasters\Tests\DTO;

use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DtoCasters\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public string $name;
    #[MapTo('register_number')]
    public string $registerNumber;
    #[MapTo('customer_address')]
    public ?string $customerAddress = null;
    public ?int $age = null;
}

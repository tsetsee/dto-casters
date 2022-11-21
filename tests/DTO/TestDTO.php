<?php

namespace Tsetsee\DTO\Tests\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Tsetsee\DTO\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public int $age;

    public function __construct(
        public string $name,
        #[SerializedName('register_number')]
        public string $registerNumber,
    ) {
    }
}

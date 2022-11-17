<?php

namespace Tsetsee\DTO\Tests\DTO;

use Tsetsee\DTO\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public int $age;

    public function __construct(
        public string $name,
    ) {
    }
}

<?php

namespace Tsetsee\DTO\Tests\DTO;

use Tsetsee\DTO\Attributes\MapTo;
use Tsetsee\DTO\DTO\TseDTO;

class ChildDTO extends TseDTO
{
    public int $id;
    #[MapTo('name')]
    public string $title;
}

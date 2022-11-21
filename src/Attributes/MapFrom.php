<?php

namespace Tsetsee\DTO\Attributes;

use Attribute;

#[Attribute()]
class MapFrom
{
    public function __construct(public string $name)
    {
    }
}

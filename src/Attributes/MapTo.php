<?php

namespace Tsetsee\DTO\Attributes;

use Attribute;

#[\Attribute()]
class MapTo
{
    public function __construct(public string $name)
    {
    }
}

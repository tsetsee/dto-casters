<?php

namespace Tsetsee\DTO\Attributes;

#[\Attribute()]
class MapTo
{
    public function __construct(public string $name)
    {
    }
}

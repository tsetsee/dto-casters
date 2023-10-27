<?php

namespace Tsetsee\DTO\Attributes;

#[\Attribute()]
class MapFrom
{
    public function __construct(public string $name)
    {
    }
}

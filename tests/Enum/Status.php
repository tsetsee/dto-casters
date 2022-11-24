<?php

namespace Tsetsee\DTO\Tests\Enum;

enum Status: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}

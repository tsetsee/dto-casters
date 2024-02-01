<?php

namespace Tsetsee\DTO\Tests\DTO;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Tsetsee\DTO\DTO\TseDTO;

class AttributeInfoDTO extends TseDTO
{
    #[SerializedName('@school')]
    public ?string $school;

    #[SerializedName('#')]
    public ?string $hobby;
}

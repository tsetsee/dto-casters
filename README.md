# tsetsee/php-dto

PHP Data Transfer Object Library

## Getting starts
You should extend your class by `TseDTO`.

## Installation

```bash
$ composer require tsetsee/php-dto
```

## Features
1. `toArray()` method only based on the initialized array data.

```php
<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Tsetsee\DTO\Casters\CarbonCaster;
use Tsetsee\DTO\DTO\TseDTO;

class TestDTO extends TseDTO
{
    public string $firstName;
    public string $lastName;
    public ?string $familyName = null;
    public ?int age = null;
}
...

$dto = new TestDTO([
  'firstName' => 'Tsetsentsengel',
  'lastName' => 'Munkhbayar',
  // 'familyName' => 'Galzuud',
  'age' => 31,
]);

var_dump($dto->toArray());
...

[Output]
array() {
  ["firstName"] =>
  string(14) "Tsetsentsengel"
  ["lastName"] =>
  string(10) "Munkhbayar"
  ["age"] =>
  int 31
}

```

## Handling DateTime
1. `php-dto` supports symfony's `DateTimeNormalizer` which handles `\DateTimeInterface`,`\DateTimeImmutable`, `\DateTime`. [@see](https://symfony.com/doc/current/serializer.html#serializer-context). By default, it uses the [RFC3339](https://tools.ietf.org/html/rfc3339#section-5.8) format.

2. `php-dto` supports [Carbon](https://carbon.nesbot.com/). By default, it uses the [RFC3339](https://tools.ietf.org/html/rfc3339#section-5.8) format.

  ```php
  <?php

  namespace Tsetsee\DTO\Tests\DTO;

  use Symfony\Component\Serializer\Annotation\Context;
  use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;
  use Tsetsee\DTO\DTO\TseDTO;
  use Carbon\CarbonImmutable;

  class TestDTO extends TseDTO
  {
      #[Context(
          normalizationContext: [
              CarbonNormalizer::FORMAT_KEY => 'c',
          ],
          denormalizationContext: [
              CarbonNormalizer::FORMAT_KEY => 'm-d-Y H:i:s',
          ],
      )]
      public ?CarbonImmutable $date = null;
  }
  ```
3. Cast from timestamp.

| Format | Description |
| ------ | ----------- |
|   x    | timestamp by milliseconds |
|   X    | timestamp by seconds |

```php
<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\Carbon;
use Tsetsee\DTO\DTO\TseDTO;
use Symfony\Component\Serializer\Annotation\Context;
use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;

class TestDTO extends TseDTO
{
    #[Context(
        denormalizationContext: [
            CarbonNormalizer::FORMAT_KEY => 'X',
        ],
    )]
    public ?Carbon $dateFromTimestamp = null;
}
```

## Casting Array

You should add `adder method` if the property is an array of DTO.

```php
<?php

namespace Tsetsee\DTO\Tests\DTO;

use Carbon\Carbon;
use Tsetsee\DTO\DTO\TseDTO;
use Symfony\Component\Serializer\Annotation\Context;
use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;

class TestDTO extends TseDTO
{
    /**
     * @var array<ChildDTO>
     */
    public array $children = [];

    public function addChildren(ChildDTO $children): void
    {
        $this->children[] = $children;
    }
}
```

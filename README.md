# tsetsee/php-dto

https://github.com/spatie/data-transfer-object 's DTO have some drawbacks. This repository tries to improve it. 

Getting starts
------------------
You should extend your class by `TseDTO` instead of `DataTransferObject`.

Features
--------------------
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

Casters
----------------------
1. [Tsetsee\DTO\Casters\CarbonCaster](https://github.com/tsetsee/php-dto/blob/main/src/Casters/CarbonCaster.php)

  * Cast from timestamp

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
    #[CastWith(CarbonCaster::class, type: 'timestamp')]
    public Carbon $dateFromTimestamp;
}
```
  
  * Cast with date format. It supports [DateTime formats](https://www.php.net/manual/en/datetime.format.php)

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
    #[CastWith(CarbonCaster::class, format: 'Y-m-d H:i:s')]
    public ?CarbonImmutable $date = null;

    #[CastWith(CarbonCaster::class, format: 'c')]
    public CarbonImmutable $dateISO;
```
  * Automatically detects `Carbon` or `CarbonImmutable`
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
    #[CastWith(CarbonCaster::class, type: 'timestamp')]
    public Carbon $dateFromTimestamp;
   
    #[CastWith(CarbonCaster::class, format: 'c')]
    public CarbonImmutable $dateISO;
}
```

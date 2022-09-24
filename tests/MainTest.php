<?php

use Tsetsee\DtoCasters\Tests\DTO\TimestampDTO;

test('castings', function () {
    $dto = new TimestampDTO([
        'dateFromTimestamp' => 1664094320,
    ]);

    expect($dto->dateFromTimestamp->format('c'))->toBe('2022-09-25T08:25:20+00:00');
});

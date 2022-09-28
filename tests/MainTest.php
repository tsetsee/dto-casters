<?php

use Tsetsee\DtoCasters\Tests\DTO\TestDTO;
use Tsetsee\DtoCasters\Tests\DTO\TimestampDTO;

test('castings', function () {
    $dto = new TimestampDTO([
        'dateFromTimestamp' => 1664094320,
    ]);

    expect($dto->dateFromTimestamp->format('c'))->toBe('2022-09-25T08:25:20+00:00');
});

test('tseDTO', function () {
    $dto = new TestDTO([
        'name' => 'Test Test',
        'registerNumber' => 'УУ12234456',
        'age' => null,
    ]);

    $arr = $dto->toArray();

    expect($arr)->toMatchArray([
        'name' => 'Test Test',
        'register_number' => 'УУ12234456',
        'age' => null,
    ]);
});

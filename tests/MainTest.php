<?php

use Carbon\CarbonImmutable;
use Tsetsee\DTO\Tests\DTO\TestDTO;

test('main test', function () {
    // $dto = new TestDTO(name: 'Test Test');
    $dto = TestDTO::from([
        'name' => 'Test Test',
        'register_id' => 'УУ12234456',
        // 'age' => null,
        // 'dateFromTimestamp' => 1664094320,
        'date' => '10-29-2020 12:44:01',
        'child' => [
            'id' => 5,
            'title' => 'haha',
        ],
        // 'dateISO' => '2022-09-29T05:17:11Z',
        // 'dateNull' => null,
    ]);

    var_dump($dto);

    var_dump('------------');

    $arr = $dto->toArray();

    var_dump($arr);

    expect($arr)->toMatchArray([
        'name' => 'Test Test',
        'register_number' => 'УУ12234456',
        // 'age' => null,
        'child' => [
            'id' => 5,
            'name' => 'haha',
        ],
    ]);

    // expect($dto->dateFromTimestamp->format('c'))->toBe('2022-09-25T08:25:20+00:00');
    // expect($dto->date)->toBeInstanceOf(CarbonImmutable::class);
    // expect($dto->date->format('Y-m-d H:i:s'))->toBe('2020-10-19 16:12:25');
    // expect($dto->dateISO->format('Y-m-d H:i:s'))->toBe('2022-09-29 05:17:11');
    // expect($dto->dateNull)->toBeNull();
});

<?php

use Tsetsee\DTO\Tests\DTO\TestDTO;

test('main test', function () {
    // $dto = new TestDTO(name: 'Test Test');
    $dto = TestDTO::from([
        'name' => 'Test Test',
        'register_id' => 'УУ12234456',
        'notneeded' => 'asdf',
        'dateFromTimestamp' => 1664094320,
        'date' => '10-29-2020 12:44:01',
        'child' => [
            'id' => 5,
            'title' => 'haha',
            'createdAt' => '2022-09-29T05:17:11Z',
            'notneeded' => 'asdf',
            'status' => 'accepted',
        ],
        'dateNull' => null,
    ]);

    expect($dto)
        ->name->toBe('Test Test')
        ->registerNumber->toBe('УУ12234456')
        ->dateFromTimestamp->format('Y-m-d H:i:s')->toBe('2022-09-25 08:25:20')
        ->date->format('Y-m-d H:i:s')->toBe('2020-10-29 12:44:01')
    ;

    expect($dto->child)
        ->id->toBe(5)
        ->title->toBe('haha')
        ->createdAt->format('Y-m-d H:i:s')->toBe('2022-09-29 05:17:11')
    ;

    $arr = $dto->toArray();

    expect($arr)
        ->not()->toHaveKeys(['age'])
        ->toMatchArray([
            'name' => 'Test Test',
            'register_number' => 'УУ12234456',
            'dateFromTimestamp' => '2022-09-25T08:25:20+00:00',
            'date' => '2020-10-29T12:44:01+00:00',
            'dateNull' => null,
            'child' => [
                'id' => 5,
                'name' => 'haha',
                'createdAt' => '2022-09-29 05:17:11',
            ],
        ])
    ;
});

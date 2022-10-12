<?php

namespace Tsetsee\DTO\DTO;

use ReflectionClass;
use ReflectionProperty;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

abstract class TseDTO extends DataTransferObject
{
    /**
     * @param array<string|mixed>|array<mixed> $args
     */
    final public function __construct(...$args)
    {
        if (is_array($args[0] ?? null)) {
            $args = $args[0];
        }

        parent::__construct($args);

        $class = new ReflectionClass(static::class);
        $properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);

        $data = [];
        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $mapToAttribute = $property->getAttributes(MapTo::class);
            $name = count($mapToAttribute) ? $mapToAttribute[0]->newInstance()->name : $property->getName();

            $data[$property->getName()] = $name;
        }

        foreach (array_keys($args) as $name) {
            if (isset($data[$name])) {
                $this->onlyKeys[] = $data[$name];
            }
        }
    }

    /**
     * @param array<mixed> $data
     *
     * @return array<static>
     */
    public static function fromArray(array $data): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = new static($item);
        }

        return $result;
    }
}

<?php

namespace Tsetsee\DTO\DTO;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Tsetsee\DTO\Serializer\AttributeNameConverter;
use Tsetsee\DTO\Serializer\Normalizer\CarbonNormalizer;

abstract class TseDTO
{
    /**
     * @return mixed
     */
    public function toArray()
    {
        return static::getSerializer()->normalize($this);
    }

    /**
     * @param mixed          $payload
     * @param string         $source
     * @param ?array<string> $groups
     */
    public static function from(
        $payload,
        $source = 'array',
        ?array $groups = null
    ): static {
        $serializer = self::getSerializer();
        if ('array' === $source) {
            /** @var static $object */
            $object = $serializer->denormalize($payload, static::class);
        } else {
            /** @var static $object */
            $object = $serializer->deserialize($payload, static::class, $source);
        }

        return $object;
    }

    /**
     * @param array<mixed>   $data
     * @param ?array<string> $groups
     *
     * @return array<TseDTO>
     */
    public static function fromArray(array $data, ?array $groups = null): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = self::from($item, 'array', $groups);
        }

        return $result;
    }

    protected static function getSerializer(): Serializer
    {
        $encoders = [new JsonEncoder(), new XmlEncoder()];
        $normalizers = [
            new CarbonNormalizer(),
            new DateTimeNormalizer(),
            new ArrayDenormalizer(),
            static::getObjectNormalizer(),
        ];

        return new Serializer($normalizers, $encoders);
    }

    protected static function getObjectNormalizer(): ObjectNormalizer
    {
        $loader = new AnnotationLoader(new AnnotationReader());
        $classMetadataFactory = new ClassMetadataFactory($loader);

        $nameConverter = new AttributeNameConverter();

        return new ObjectNormalizer($classMetadataFactory, $nameConverter, null, new ReflectionExtractor());
        // return new ObjectNormalizer(null, $nameConverter, null, new ReflectionExtractor());
    }
}

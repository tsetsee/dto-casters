<?php

namespace Tsetsee\DTO\DTO;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class TseDTO
{
    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this::getObjectNormalizer()->normalize($this);
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
        if ('array' === $source) {
            $objectNormalizer = static::getObjectNormalizer();
            /** @var static $object */
            $object = $objectNormalizer->denormalize($payload, static::class);
        } else {
            $serializer = self::getSerializer();
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
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [static::getObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }

    protected static function getObjectNormalizer(): ObjectNormalizer
    {
        $loader = new AnnotationLoader(new AnnotationReader());
        $classMetadataFactory = new ClassMetadataFactory($loader);

        return new ObjectNormalizer($classMetadataFactory);
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Model;

use JsonSerializable;
use TypeError;

abstract class BaseModel implements JsonSerializable
{
    final private function __construct()
    {
    }

    /**
     * @param mixed|array<string, mixed>|static $value
     *
     * @return static
     *
     * @throws TypeError
     */
    public static function create($value): self
    {
        if ($value instanceof static) {
            return $value;
        }

        if (is_array($value)) {
            $obj = new static();
            foreach ($value as $k => $v) {
                if (!property_exists($obj, $k)) {
                    throw new TypeError(sprintf(
                        'Invalid property - %s::$%s',
                        get_class($obj),
                        $k
                    ));
                }
                if (!is_null($v)) {
                    $obj->$k = $v;
                }
            }
            return $obj;
        }

        throw new TypeError('Expected an array or instance of ' . static::class);
    }

    /**
     * @param array<mixed|array<string, mixed>|static> $values
     *
     * @return static[]
     *
     * @throws TypeError
     */
    public static function createList(array $values): array
    {
        return array_map([static::class, 'create'], $values);
    }

    /**
     * @param array<string, mixed>|array<mixed>|self $data
     *
     * @return array<string, mixed>|array<mixed>
     */
    protected static function arraySerialize($data)
    {
        $result = [];
        // @phpstan-ignore-next-line foreach.nonIterable
        foreach ($data as $key => $value) {
            if (is_array($value) || $value instanceof self) {
                $result[$key] = self::arraySerialize($value);
            } elseif (!is_null($value)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return self::arraySerialize($this);
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Model;

use InvalidArgumentException;
use LengthException;

class StringType
{
    /**
     * @param mixed $value
     *
     * @throws LengthException
     */
    public static function castMaxLength(string $name, $value, int $length): string
    {
        // @phpstan-ignore-next-line argument.type
        $str = strval($value);

        if (strlen($str) > $length) {
            throw new LengthException(sprintf(
                '%s cannot be longer than %d characters',
                $name,
                $length
            ));
        }

        return $str;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function oneOf(string $name, string $value, string ...$acceptableValues): string
    {
        if (!in_array($value, $acceptableValues)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid %s, value must be one of %s',
                $name,
                implode(', ', $acceptableValues)
            ));
        }

        return $value;
    }
}

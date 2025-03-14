<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Model;

use DateTimeImmutable;
use DateTimeInterface;
use DateMalformedStringException;

class DateType
{
    /**
     * @throws DateMalformedStringException
     */
    public static function create(int|string|DateTimeInterface $date): DateTimeInterface
    {
        if (is_int($date)) {
            return (new DateTimeImmutable())->setTimestamp($date);
        }

        if (is_string($date)) {
            return new DateTimeImmutable($date);
        }

        return $date;
    }
}

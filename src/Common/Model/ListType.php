<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Common\Model;

use TypeError;

class ListType
{
    /**
     * @param int[] $items
     * @return int[]
     * 
     * @throws TypeError
     */
    public static function allOfInt(string $property, array $items): array
    {
        foreach ($items as $item) {
            // @phpstan-ignore-next-line function.alreadyNarrowedType
            if (!is_int($item)) {
                throw new TypeError(sprintf(
                    'Each %s must be an int',
                    $property
                ));
            }
        }

        return $items;
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\StringType;

class Weight extends BaseModel
{
    public const WEIGHT_POUNDS = 'pounds';
    public const WEIGHT_OUNCES = 'ounces';
    public const WEIGHT_GRAMS = 'grams';

    /**
     * @var float Weight value.
     */
    public float $value;

    /**
     * @var string|self::WEIGHT_* Units of weight.
     */
    public string $units {
        set(string $units) {
            $this->units = StringType::oneOf(
                __PROPERTY__,
                $units,
                self::WEIGHT_POUNDS,
                self::WEIGHT_OUNCES,
                self::WEIGHT_GRAMS
            );
        }
    }
}

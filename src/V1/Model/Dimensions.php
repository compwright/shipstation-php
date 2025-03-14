<?php
declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\StringType;

class Dimensions extends BaseModel
{
    public const UNITS_INCHES = 'inches';
    public const UNITS_CENTIMETERS = 'centimeters';

    /**
     * @var float Length of package.
     */
    public float $length;

    /**
     * @var float Width of package.
     */
    public float $width;

    /**
     * @var float Height of package.
     */
    public float $height;

    /**
     * @var string|self::UNITS_* Units of measurement.
     */
    public string $units {
        set (string $units) {
            $this->units = StringType::oneOf(
                __PROPERTY__,
                $units,
                self::UNITS_INCHES,
                self::UNITS_CENTIMETERS
            );
        }
    }
}

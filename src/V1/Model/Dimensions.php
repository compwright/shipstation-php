<?php
declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;
use Compwright\ShipstationPhp\Common\Model\StringType;

class Dimensions extends BaseModel
{
    public const UNITS_ENGLISH = 'inches';
    public const UNITS_METRIC = 'centimeters';

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
                self::UNITS_ENGLISH,
                self::UNITS_METRIC
            );
        }
    }
}

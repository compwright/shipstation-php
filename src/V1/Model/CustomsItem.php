<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;

class CustomsItem extends BaseModel
{
    /**
     * @var string A short description of the CustomItem
     */
    public string $description;

    /**
     * @var int The quantity for this line item.
     */
    public int $quantity;

    /**
     * @var float The value (in USD) of the line item.
     */
    public float $value;

    /**
     * @var string The Harmonized Commodity Code for this line item.
     */
    public string $harmonizedTariffCode;

    /**
     * @var string The 2-character ISO country code where the item originated.
     */
    public string $countryOfOrigin;
}

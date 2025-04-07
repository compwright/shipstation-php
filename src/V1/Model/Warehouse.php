<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;

class Warehouse extends BaseModel
{
    public ?string $warehouseName;

    public Address $originAddress;

    public ?Address $returnAddress;

    public ?bool $isDefault;
}

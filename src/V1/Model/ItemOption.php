<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;

class ItemOption extends BaseModel
{
    /**
     * @var string Name of item option. Example: "Size"
     */
    public string $name;

    /**
     * @var string The value of item option. Example: "Medium"
     */
    public string $value;
}

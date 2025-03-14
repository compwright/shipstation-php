<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Model;

use Compwright\ShipstationPhp\Common\Model\BaseModel;

class Address extends BaseModel
{
    /**
     * @var string Name of person
     */
    public string $name;

    /**
     * @var string Name of company
     */
    public string $company;

    /**
     * @var string First line of address
     */
    public string $street1;

    /**
     * @var ?string Second line of address
     */
    public ?string $street2;

    /**
     * @var ?string Third line of address
     */
    public ?string $street3;

    /**
     * @var string City
     */
    public string $city;

    /**
     * @var string State
     */
    public string $state;

    /**
     * @var string Postal Code
     */
    public string $postalCode;

    /**
     * @var string Country Code. The two-cahracter ISO country code is required.
     */
    public string $country;

    /**
     * @var string Telephone number.
     */
    public string $phone;

    /**
     * @var bool Specifies whether the given address is residential.
     */
    public bool $residential;
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2;

use Compwright\ShipstationPhp\ApiClient;

class InventoryApiCollection extends ShippingApiCollection
{
    // public readonly Api\InventoryApi $inventory;
    // public readonly Api\WarehousesApi $warehouses;

    public function __construct(ApiClient $client)
    {
        parent::__construct($client);
        // $this->inventory = new Api\InventoryApi($client, $config);
        // $this->warehouses = new Api\WarehousesApi($client, $config);
    }
}

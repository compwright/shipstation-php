<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2;

use GuzzleHttp\Client;

class InventoryApi extends ShippingApi
{
    // public readonly Api\InventoryApi $inventory;
    // public readonly Api\WarehousesApi $warehouses;

    public function __construct(Client $client)
    {
        parent::__construct($client);
        // $this->inventory = new Api\InventoryApi($client, $config);
        // $this->warehouses = new Api\WarehousesApi($client, $config);
    }
}

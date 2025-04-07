<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1;

use Compwright\EasyApi\ApiClient;

class LegacyApiCollection
{
    public readonly Api\Order $order;
    public readonly Api\Shipment $shipment;
    public readonly Api\Tag $tag;
    public readonly Api\Warehouse $warehouse;

    public function __construct(ApiClient $client)
    {
        $this->order = new Api\Order($client);
        $this->shipment = new Api\Shipment($client);
        $this->tag = new Api\Tag($client);
        $this->warehouse = new Api\Warehouse($client);
    }
}

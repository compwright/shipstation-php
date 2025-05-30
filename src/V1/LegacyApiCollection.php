<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1;

use Compwright\EasyApi\ApiClient;

class LegacyApiCollection
{
    public readonly Api\Carrier $carrier;
    public readonly Api\Order $order;
    public readonly Api\Shipment $shipment;
    public readonly Api\Tag $tag;
    public readonly Api\User $user;
    public readonly Api\Warehouse $warehouse;

    public function __construct(ApiClient $client)
    {
        $this->carrier = new Api\Carrier($client);
        $this->order = new Api\Order($client);
        $this->shipment = new Api\Shipment($client);
        $this->tag = new Api\Tag($client);
        $this->user = new Api\User($client);
        $this->warehouse = new Api\Warehouse($client);
    }
}

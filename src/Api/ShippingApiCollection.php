<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api;

use Compwright\ShipstationPhp\ApiClient;

/**
 * @see https://docs.shipstation.com
 */
class ShippingApiCollection
{
    public readonly V2\Batch $batches;
    public readonly V2\Carrier $carriers;
    public readonly V2\Download $downloads;
    public readonly V2\Label $labels;
    public readonly V2\Manifest $manifests;
    public readonly V2\Pickup $packagePickups;
    public readonly V2\Package $packageTypes;
    public readonly V2\Rate $rates;
    public readonly V2\Shipment $shipments;
    public readonly V2\Tag $tags;
    public readonly V2\Tracking $tracking;
    public readonly V2\Webhook $webhooks;

    public function __construct(ApiClient $client)
    {
        $this->batches = new V2\Batch($client);
        $this->carriers = new V2\Carrier($client);
        $this->downloads = new V2\Download($client);
        $this->labels = new V2\Label($client);
        $this->manifests = new V2\Manifest($client);
        $this->packagePickups = new V2\Pickup($client);
        $this->packageTypes = new V2\Package($client);
        $this->rates = new V2\Rate($client);
        $this->shipments = new V2\Shipment($client);
        $this->tags = new V2\Tag($client);
        $this->tracking = new V2\Tracking($client);
        $this->webhooks = new V2\Webhook($client);
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2;

use Compwright\ShipstationPhp\Common\ApiClient;

/**
 * @see https://docs.shipstation.com
 */
class ShippingApiCollection
{
    public readonly Api\Batch $batches;
    public readonly Api\Carrier $carriers;
    public readonly Api\Download $downloads;
    public readonly Api\Label $labels;
    public readonly Api\Manifest $manifests;
    public readonly Api\Pickup $packagePickups;
    public readonly Api\Package $packageTypes;
    public readonly Api\Rate $rates;
    public readonly Api\Shipment $shipments;
    public readonly Api\Tag $tags;
    public readonly Api\Tracking $tracking;
    public readonly Api\Webhook $webhooks;

    public function __construct(ApiClient $client)
    {
        $this->batches = new Api\Batch($client);
        $this->carriers = new Api\Carrier($client);
        $this->downloads = new Api\Download($client);
        $this->labels = new Api\Label($client);
        $this->manifests = new Api\Manifest($client);
        $this->packagePickups = new Api\Pickup($client);
        $this->packageTypes = new Api\Package($client);
        $this->rates = new Api\Rate($client);
        $this->shipments = new Api\Shipment($client);
        $this->tags = new Api\Tag($client);
        $this->tracking = new Api\Tracking($client);
        $this->webhooks = new Api\Webhook($client);
    }
}

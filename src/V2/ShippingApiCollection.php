<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2;

use Compwright\ShipstationPhp\ApiClient;

/**
 * @see https://docs.shipstation.com
 */
class ShippingApiCollection
{
    // public readonly Api\BatchesApi $batches;
    public readonly Api\Carrier $carriers;
    // public readonly Api\DownloadsApi $downloads;
    public readonly Api\Label $labels;
    // public readonly Api\ManifestsApi $manifests;
    // public readonly Api\PackagePickupsApi $packagePickups;
    // public readonly Api\PackageTypesApi $packageTypes;
    public readonly Api\Rate $rates;
    public readonly Api\Shipment $shipments;
    public readonly Api\Tag $tags;
    // public readonly Api\TrackingApi $tracking;
    // public readonly Api\WebhooksApi $webhooks;

    public function __construct(ApiClient $client)
    {
        // $this->batches = new Api\Batche($client);
        $this->carriers = new Api\Carrier($client);
        // $this->downloads = new Api\Download($client);
        $this->labels = new Api\Label($client);
        // $this->manifests = new Api\Manifest($client);
        // $this->packagePickups = new Api\PackagePickup($client);
        // $this->packageTypes = new Api\PackageType($client);
        $this->rates = new Api\Rate($client);
        $this->shipments = new Api\Shipment($client);
        $this->tags = new Api\Tag($client);
        // $this->tracking = new Api\Tracking($client);
        // $this->webhooks = new Api\Webhook($client);
    }
}

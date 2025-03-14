<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2;

use GuzzleHttp\Client;

class ShippingApi
{
    // public readonly Api\BatchesApi $batches;
    public readonly Endpoints\CarriersApi $carriers;
    // public readonly Api\DownloadsApi $downloads;
    // public readonly Api\LabelsApi $labels;
    // public readonly Api\ManifestsApi $manifests;
    // public readonly Api\PackagePickupsApi $packagePickups;
    // public readonly Api\PackageTypesApi $packageTypes;
    public readonly Endpoints\RatesApi $rates;
    public readonly Endpoints\ShipmentsApi $shipments;
    // public readonly Api\TagsApi $tags;
    // public readonly Api\TrackingApi $tracking;
    // public readonly Api\WebhooksApi $webhooks;

    public function __construct(Client $client)
    {
        // $this->batches = new Api\BatchesApi($client, $config);
        $this->carriers = new Endpoints\CarriersApi($client);
        // $this->downloads = new Api\DownloadsApi($client, $config);
        // $this->labels = new Api\LabelsApi($client, $config);
        // $this->manifests = new Api\ManifestsApi($client, $config);
        // $this->packagePickups = new Api\PackagePickupsApi($client, $config);
        // $this->packageTypes = new Api\PackageTypesApi($client, $config);
        $this->rates = new Endpoints\RatesApi($client);
        $this->shipments = new Endpoints\ShipmentsApi($client);
        // $this->tags = new Api\TagsApi($client, $config);
        // $this->tracking = new Api\TrackingApi($client, $config);
        // $this->webhooks = new Api\WebhooksApi($client, $config);
    }
}

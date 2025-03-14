<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Endpoints;

use Compwright\ShipstationPhp\ApiClient;

/**
 * @method array<string, mixed> listAll()
 * @method array<string, mixed> getByExternalId(string $id)
 * @method array<string, mixed> getById(string $id)
 * @method null cancel(string $id)
 * @method array<string, mixed> getRates(string $id)
 * @method array<string, mixed> addTag(string $id, string $tag)
 * @method null removeTag(string $id, string $tag)
 */
class ShipmentsApi extends ApiClient
{
    protected string $baseUrl = '/v2/shipments';

    /** @inheritdoc */
    protected array $operations = [
        'listAll' => 'GET ',
        'getByExternalId' => 'GET /external_shipment_id/%s',
        'getById' => 'GET /%s',
        'cancel' => 'PUT /%s/cancel',
        'getRates' => 'GET /%s/rates',
        'addTag' => 'POST /%s/tags/%s',
        'removeTag' => 'DELETE /%s/tags/%s',
    ];
}

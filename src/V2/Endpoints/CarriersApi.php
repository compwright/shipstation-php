<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Endpoints;

use Compwright\ShipstationPhp\ApiClient;

/**
 * @method array{carriers:array<array<string, mixed>>} listAll()
 * @method array<string, mixed> getById(string $id)
 * @method array{options:array<array<string, mixed>>} getOptions(string $id)
 * @method array{packages:array<array<string, mixed>>} getPackageTypes(string $id)
 * @method array{services:array<array<string, mixed>>} getServices(string $id)
 */
class CarriersApi extends ApiClient
{
    protected string $baseUrl = '/v2/carriers';

    /** @inheritdoc */
    protected array $operations = [
        'listAll' => 'GET ',
        'getById' => 'GET /%s',
        'getOptions' => 'GET /%s/options',
        'getPackageTypes' => 'GET /%s/packages',
        'getServices' => 'GET /%s/services',
    ];
}

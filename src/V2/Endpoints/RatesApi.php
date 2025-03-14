<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Endpoints;

use Compwright\ShipstationPhp\ApiClient;

/**
 * @method array<string, mixed> getShippingRates(array<string, mixed> $request)
 */
class RatesApi extends ApiClient
{
    protected string $baseUrl = '/v2/rates';

    /** @inheritdoc */
    protected array $operations = [
        'getShippingRates' => 'POST ',
    ];
}

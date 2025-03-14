<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/rates
 */
class Rate
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/rates/calculate_rates
     */
    public function getShippingRates(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/rates')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/rates/estimate_rates
     */
    public function estimate(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/rates/estimate')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/rates/get_rate_by_id
     */
    public function getById(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/rates/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }
}

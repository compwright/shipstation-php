<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result;

class Rate
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $body
     */
    public function getShippingRates(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/rates')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     */
    public function estimate(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/rates/estimate')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    public function getById(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/rates/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }
}

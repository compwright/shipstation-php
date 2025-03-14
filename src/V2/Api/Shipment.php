<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\PaginatedIterableResult;
use Compwright\ShipstationPhp\Result;

class Shipment
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $params
     */
    public function listAll(array $params = []): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments')
            ->setQueryParams($params);
        $result = new PaginatedIterableResult('shipments');
        return $this->client->__invoke($op, $result);
    }

    public function getByExternalId(string $externalId): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments/external_shipment_id/%s')
            ->bindArgs($externalId);
        return $this->client->__invoke($op, new Result());
    }

    public function getById(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }

    public function cancel(string $id): Result
    {
        $op = Operation::fromSpec('PUT /v2/shipments/%s/cancel')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $params
     */
    public function getRates(string $id, array $params = []): Result
    {
        $op = Operation::fromSpec('PUT /v2/shipments/%s/rates')
            ->bindArgs($id)
            ->setQueryParams($params);
        return $this->client->__invoke($op, new Result());
    }

    public function addTag(string $id, string $tag): Result
    {
        $op = Operation::fromSpec('POST /v2/shipments/%s/tags/%s')
            ->bindArgs($id, $tag);
        return $this->client->__invoke($op, new Result());
    }

    public function removeTag(string $id, string $tag): Result
    {
        $op = Operation::fromSpec('DELETE /v2/shipments/%s/tags/%s')
            ->bindArgs($id, $tag);
        return $this->client->__invoke($op, new Result());
    }
}

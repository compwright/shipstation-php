<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\EmptyResult;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\PaginatedIterableResult;
use Compwright\ShipstationPhp\Result;

/**
 * @see https://docs.shipstation.com/openapi/shipments
 */
class Shipment
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $params
     * 
     * @see https://docs.shipstation.com/openapi/shipments/list_shipments
     */
    public function listAll(array $params = []): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments')
            ->setQueryParams($params);
        $result = new PaginatedIterableResult('shipments');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/shipments/get_shipment_by_external_id
     */
    public function getByExternalId(string $externalId): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments/external_shipment_id/%s')
            ->bindArgs($externalId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/shipments/get_shipment_by_id
     */
    public function getById(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/shipments/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/shipments/cancel_shipments
     */
    public function cancel(string $id): EmptyResult
    {
        $op = Operation::fromSpec('PUT /v2/shipments/%s/cancel')
            ->bindArgs($id);
        return $this->client->__invoke($op, new EmptyResult());
    }

    /**
     * @param array<string, mixed> $params
     * 
     * @see https://docs.shipstation.com/openapi/shipments/list_shipment_rates
     */
    public function getRates(string $id, array $params = []): Result
    {
        $op = Operation::fromSpec('PUT /v2/shipments/%s/rates')
            ->bindArgs($id)
            ->setQueryParams($params);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/shipments/tag_shipment
     */
    public function addTag(string $id, string $tag): Result
    {
        $op = Operation::fromSpec('POST /v2/shipments/%s/tags/%s')
            ->bindArgs($id, $tag);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/shipments/untag_shipment
     */
    public function removeTag(string $id, string $tag): EmptyResult
    {
        $op = Operation::fromSpec('DELETE /v2/shipments/%s/tags/%s')
            ->bindArgs($id, $tag);
        return $this->client->__invoke($op, new EmptyResult());
    }
}

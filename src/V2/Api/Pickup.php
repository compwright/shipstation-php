<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\EasyApi\ApiClient;
use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\ShipstationPhp\Common\Result\PaginatedIterableResult;

/**
 * @see https://docs.shipstation.com/openapi/pickups
 */
class Pickup
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $queryParams
     *
     * @see https://docs.shipstation.com/openapi/package_pickups/list_scheduled_pickups
     */
    public function listAll(array $queryParams = []): PaginatedIterableResult
    {
        $op = Operation::fromSpec('GET /v2/pickups')
            ->setQueryParams($queryParams);
        $result = new PaginatedIterableResult('pickups');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/package_pickups/schedule_pickup
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/pickups')
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/package_pickups/get_pickup_by_id
     */
    public function getById(string $pickupId): Result
    {
        $op = Operation::fromSpec('POST /v2/pickups/%s')
            ->bindArgs($pickupId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/package_pickups/get_pickup_by_id
     */
    public function delete(string $pickupId): Result
    {
        $op = Operation::fromSpec('DELETE /v2/pickups/%s')
            ->bindArgs($pickupId);
        return $this->client->__invoke($op, new Result());
    }
}

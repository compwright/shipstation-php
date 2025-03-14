<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\EmptyResult;
use Compwright\ShipstationPhp\Common\Result\IterableResult;
use Compwright\ShipstationPhp\Common\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/packages
 */
class Package
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/package_types/list_package_types
     */
    public function listAll(): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/packages');
        $result = new IterableResult('packages');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/package_types/create_package_type
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/packages')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/package_types/get_package_type_by_id
     */
    public function getById(string $packageId): Result
    {
        $op = Operation::fromSpec('POST /v2/packages/%s')
            ->bindArgs($packageId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/package_types/update_package_type
     */
    public function update(string $pickupId, array $body): Result
    {
        $op = Operation::fromSpec('PUT /v2/pickups/%s')
            ->bindArgs($pickupId)
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/package_types/delete_package_typ
     */
    public function delete(string $packageId): EmptyResult
    {
        $op = Operation::fromSpec('DELETE /v2/packages/%s')
            ->bindArgs($packageId);
        return $this->client->__invoke($op, new EmptyResult());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\IterableResult;
use Compwright\ShipstationPhp\Common\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/warehouses
 */
class Warehouse
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/warehouses/list_warehouses
     */
    public function listAll(): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/warehouses');
        $result = new IterableResult('warehouses');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/warehouses/get_warehouse_by_id
     */
    public function getOne(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/warehouses/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }
}

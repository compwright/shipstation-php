<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\EasyApi\ApiClient;
use Compwright\ShipstationPhp\V1\Model\Warehouse as WarehouseModel;

class Warehouse
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/warehouses/list/
     */
    public function listAll(): Result
    {
        $op = Operation::fromSpec('GET /warehouses');
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/warehouses/create/
     */
    public function create(WarehouseModel $body): Result
    {
        $op = Operation::fromSpec('POST /warehouses/createwarehouse')
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/warehouses/get/
     */
    public function getById(int|string $warehouseId): Result
    {
        $op = Operation::fromSpec('GET /warehouses/%s')
            ->bindArgs($warehouseId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/warehouses/update/
     */
    public function update(int|string $warehouseId, WarehouseModel $body): Result
    {
        $op = Operation::fromSpec('PUT /warehouses/%s')
            ->bindArgs($warehouseId)
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/warehouses/delete/
     */
    public function delete(int|string $warehouseId): Result
    {
        $op = Operation::fromSpec('DELETE /warehouses/%s')
            ->bindArgs($warehouseId);
        return $this->client->__invoke($op, new Result());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V1;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result\IterableResult;
use Compwright\ShipstationPhp\Result\PaginatedIterableResult;
use Compwright\ShipstationPhp\Result\Result;
use LengthException;

class Order
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/add-tag/
     */
    public function addTag(int|string $orderId, int|string $tagId): Result
    {
        $op = Operation::fromSpec('POST /orders/addtag')
            ->setBody(compact('orderId', 'tagId'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/assign-user/
     */
    public function assignUser(int|string $userId, int|string ...$orderIds): Result
    {
        $op = Operation::fromSpec('POST /orders/assignuser')
            ->setBody(compact('orderIds', 'userId'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://www.shipstation.com/docs/api/orders/create-label/
     */
    public function createLabel(array $body): Result
    {
        $op = Operation::fromSpec('POST /orders/createlabelfororder')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<array<string, mixed>> $body
     * 
     * @see https://www.shipstation.com/docs/api/orders/create-update-multiple-orders/
     */
    public function createOrUpdateMultiple(array $body): IterableResult
    {
        if (count($body) > 100) {
            throw new LengthException('Cannot create or update more than 100 orders at a time');
        }
        $op = Operation::fromSpec('POST /orders/createorders')
            ->setBody($body);
        return $this->client->__invoke($op, new IterableResult('results'));
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://www.shipstation.com/docs/api/orders/create-update-order/
     */
    public function createOrUpdate(array $body): Result
    {
        $op = Operation::fromSpec('POST /orders/createorder')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/delete/
     */
    public function delete(int|string $orderId): Result
    {
        $op = Operation::fromSpec('DELETE /orders/%s')
            ->bindArgs($orderId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/get-order/
     */
    public function getById(int|string $orderId): Result
    {
        $op = Operation::fromSpec('GET /orders/%s')
            ->bindArgs($orderId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/hold-order-until/
     */
    public function holdUntil(int|string $orderId, string $holdUntilDate): Result
    {
        $op = Operation::fromSpec('POST /orders/holduntil')
            ->setBody(compact('orderId', 'holdUntilDate'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $query
     *
     * @see https://www.shipstation.com/docs/api/orders/list-by-tag/
     */
    public function listByTag(array $query): PaginatedIterableResult
    {
        $op = Operation::fromSpec('GET /orders/listbytag')
            ->setQueryParams($query);
        return $this->client->__invoke($op, new PaginatedIterableResult('orders'));
    }

    /**
     * @param array<string, mixed> $query
     *
     * @see https://www.shipstation.com/docs/api/orders/list-orders/
     */
    public function listAll(array $query = []): PaginatedIterableResult
    {
        $op = Operation::fromSpec('GET /orders');
        if (count($query) > 0) {
            $op->setQueryParams($query);
        }
        return $this->client->__invoke($op, new PaginatedIterableResult('orders'));
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://www.shipstation.com/docs/api/orders/mark-as-shipped/
     */
    public function markShipped(int|string $orderId, array $body): Result
    {
        $body['orderId'] = $orderId;
        $op = Operation::fromSpec('POST /orders/markasshipped')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/remove-tag/
     */
    public function removeTag(int|string $orderId, int|string $tagId): Result
    {
        $op = Operation::fromSpec('POST /orders/removetag')
            ->setBody(compact('orderId', 'tagId'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/restore-from-hold/
     */
    public function restoreFromHold(int|string $orderId): Result
    {
        $op = Operation::fromSpec('POST /orders/restorefromhold')
            ->setBody(compact('orderId'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/orders/unassign-user/
     */
    public function unassign(int|string ...$orderIds): Result
    {
        $op = Operation::fromSpec('POST /orders/unassignuser')
            ->setBody(compact('orderIds'));
        return $this->client->__invoke($op, new Result());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\EmptyResult;
use Compwright\ShipstationPhp\Common\Result\IterableResult;
use Compwright\ShipstationPhp\Common\Result\Result;
use Compwright\ShipstationPhp\Common\Result\PaginatedIterableResult;

/**
 * @see https://docs.shipstation.com/openapi/batches
 */
class Batch
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param null|array<string, mixed> $queryParams
     * 
     * @see https://docs.shipstation.com/openapi/batches/list_batches
     */
    public function listAll(?array $queryParams): PaginatedIterableResult
    {
        $op = Operation::fromSpec('GET /v2/batches');
        if ($queryParams) {
            $op->setQueryParams($queryParams);
        }
        $result = new PaginatedIterableResult('batches');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/batches/create_batch
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/batches')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/batches/get_batch_by_external_id
     */
    public function getByExternalId(string $externalBatchId): Result
    {
        $op = Operation::fromSpec('POST /v2/batches/external_batch_id/%s')
            ->bindArgs($externalBatchId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/batches/delete_batch
     */
    public function delete(string $batchId): EmptyResult
    {
        $op = Operation::fromSpec('DELETE /v2/batches/%s')
            ->bindArgs($batchId);
        return $this->client->__invoke($op, new EmptyResult());
    }

    /**
     * @see https://docs.shipstation.com/openapi/batches/get_batch_by_id
     */
    public function getById(string $batchId): Result
    {
        $op = Operation::fromSpec('POST /v2/batches/%s')
            ->bindArgs($batchId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/batches/update_batch
     */
    public function archive(string $batchId): EmptyResult
    {
        $op = Operation::fromSpec('PUT /v2/batches/%s')
            ->bindArgs($batchId);
        return $this->client->__invoke($op, new EmptyResult());
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/batches/create_batch
     */
    public function addToBatch(string $batchId, array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/batches/%s/add')
            ->bindArgs($batchId)
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param null|array<string, mixed> $queryParams
     * 
     * @see https://docs.shipstation.com/openapi/batches/list_batch_errors
     */
    public function getErrors(string $batchId, ?array $queryParams = null): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/batches/%s/errors')
            ->bindArgs($batchId);
        if ($queryParams) {
            $op->setQueryParams($queryParams);
        }
        $result = new IterableResult('errors');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/batches/process_batch
     */
    public function processLabels(string $batchId): EmptyResult
    {
        $op = Operation::fromSpec('POST /v2/batches/%s/process/labels')
            ->bindArgs($batchId);
        return $this->client->__invoke($op, new EmptyResult());
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/batches/remove_from_batch
     */
    public function removeFromBatch(string $batchId, array $body): EmptyResult
    {
        $op = Operation::fromSpec('POST /v2/batches/%s/remove')
            ->bindArgs($batchId)
            ->setBody($body);
        return $this->client->__invoke($op, new EmptyResult());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V2;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result\PaginatedIterableResult;
use Compwright\ShipstationPhp\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/manifests
 */
class Manifest
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @param array<string, mixed> $queryParams
     * 
     * @see https://docs.shipstation.com/openapi/manifests/list_manifests
     */
    public function listAll(array $queryParams = []): PaginatedIterableResult
    {
        $op = Operation::fromSpec('GET /v2/manifests')
            ->setQueryParams($queryParams);
        $result = new PaginatedIterableResult('manifests');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @param array<string, mixed> $body
     * 
     * @see https://docs.shipstation.com/openapi/manifests/create_manifest
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/manifests')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/manifests/get_manifest_by_id
     */
    public function getById(string $manifestId): Result
    {
        $op = Operation::fromSpec('POST /v2/manifests/%s')
            ->bindArgs($manifestId);
        return $this->client->__invoke($op, new Result());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\EasyApi\ApiClient;
use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\ShipstationPhp\Common\Result\PaginatedIterableResult;

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
            ->setBody(new JsonBody($body));
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

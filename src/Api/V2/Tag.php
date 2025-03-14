<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V2;

use Compwright\ShipstationPhp\ApiClient;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result\IterableResult;
use Compwright\ShipstationPhp\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/tags
 */
class Tag
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/tags/list_tags
     */
    public function listAll(): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/tags');
        $result = new IterableResult('tags');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/tags/create_tag
     */
    public function create(string $tag): Result
    {
        $op = Operation::fromSpec('POST /v2/tags/%s')
            ->bindArgs($tag);
        return $this->client->__invoke($op, new Result());
    }
}

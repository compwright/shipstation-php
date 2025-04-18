<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\EasyApi\ApiClient;
use Compwright\EasyApi\Operation;
use Compwright\EasyApi\Result\Json\IterableResult;
use Compwright\EasyApi\Result\Json\Result;

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

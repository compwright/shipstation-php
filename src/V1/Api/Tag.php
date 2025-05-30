<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\EasyApi\Operation;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\EasyApi\ApiClient;

class Tag
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/accounts/list-tags/
     */
    public function listAll(): Result
    {
        $op = Operation::fromSpec('GET /accounts/listtags');
        return $this->client->__invoke($op, new Result());
    }
}

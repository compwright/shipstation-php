<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api\V1;

use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result\Result;
use Compwright\ShipstationPhp\ApiClient;

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

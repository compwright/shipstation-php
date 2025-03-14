<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\Result;
use Compwright\ShipstationPhp\Common\ApiClient;

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

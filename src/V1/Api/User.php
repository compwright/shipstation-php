<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\EasyApi\Operation;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\EasyApi\ApiClient;

class User
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/users/list/
     */
    public function listAll(bool $showInactive = false): Result
    {
        $op = Operation::fromSpec('GET /users');
        if ($showInactive) {
            $op->setQueryParams(['showInactive' => 'true']);
        }
        return $this->client->__invoke($op, new Result());
    }
}

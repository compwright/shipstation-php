<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\EasyApi\ApiClient;

class Carrier
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/carriers/list/
     */
    public function listAll(): Result
    {
        $op = Operation::fromSpec('GET /carriers');
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/carriers/add-funds/
     */
    public function addFunds(string $carrierCode, int $amount): Result
    {
        $op = Operation::fromSpec('POST /carriers/addfunds')
            ->setBody(new JsonBody(compact('carrierCode', 'amount')));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/carriers/get/
     */
    public function getById(string $carrierCode): Result
    {
        $op = Operation::fromSpec('GET /carriers/getcarrier')
            ->setQueryParams(compact('carrierCode'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/carriers/list-packages/
     */
    public function listPackages(string $carrierCode): Result
    {
        $op = Operation::fromSpec('GET /carriers/listpackages')
            ->setQueryParams(compact('carrierCode'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/carriers/list-services/
     */
    public function listServices(string $carrierCode): Result
    {
        $op = Operation::fromSpec('GET /carriers/listservices')
            ->setQueryParams(compact('carrierCode'));
        return $this->client->__invoke($op, new Result());
    }
}

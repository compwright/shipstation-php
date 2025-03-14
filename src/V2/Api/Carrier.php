<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\IterableResult;
use Compwright\ShipstationPhp\Operation;
use Compwright\ShipstationPhp\Result;
use Compwright\ShipstationPhp\ApiClient;

/**
 * @see https://docs.shipstation.com/openapi/carriers
 */
class Carrier
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/carriers/list_carriers
     */
    public function listAll(): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/carriers');
        $result = new IterableResult('carriers');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/carriers/get_carrier_by_id
     */
    public function getOne(string $id): Result
    {
        $op = Operation::fromSpec('GET /v2/carriers/%s')
            ->bindArgs($id);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/carriers/get_carrier_options
     */
    public function getOptions(string $id): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/carriers/%s/options')
            ->bindArgs($id);
        $result = new IterableResult('options');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/carriers/list_carrier_package_types
     */
    public function getPackageTypes(string $id): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/carriers/%s/packages')
            ->bindArgs($id);
        $result = new IterableResult('packages');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @see https://docs.shipstation.com/openapi/carriers/list_carrier_services
     */
    public function getServices(string $id): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/carriers/%s/services')
            ->bindArgs($id);
        $result = new IterableResult('services');
        return $this->client->__invoke($op, $result);
    }
}

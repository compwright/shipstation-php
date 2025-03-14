<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Result\EmptyResult;

/**
 * @see https://docs.shipstation.com/openapi/tracking
 */
class Tracking
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/tracking/stop_tracking
     */
    public function stop(string $carrier_code, string $tracking_number): EmptyResult
    {
        $op = Operation::fromSpec('POST /v2/tracking/stop')
            ->setQueryParams(compact('carrier_code', 'tracking_number'));
        return $this->client->__invoke($op, new EmptyResult());
    }
}

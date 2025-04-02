<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\EasyApi\ApiClient;
use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\Json\Result;
use Compwright\ShipstationPhp\V1\Model\Label;

class Shipment
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://www.shipstation.com/docs/api/shipments/create-label/
     */
    public function createLabel(Label $body): Result
    {
        $op = Operation::fromSpec('POST /shipments/createlabel')
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://www.shipstation.com/docs/api/shipments/void-label/
     */
    public function voidLabel(int $shipmentId): Result
    {
        $op = Operation::fromSpec('POST /shipments/voidlabel')
            ->setBody(new JsonBody(compact('shipmentId')));
        return $this->client->__invoke($op, new Result());
    }
}

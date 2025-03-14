<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\ShipstationPhp\Common\ApiClient;
use Compwright\ShipstationPhp\Common\Operation;
use Compwright\ShipstationPhp\Common\Result\IterableResult;
use Compwright\ShipstationPhp\Common\Result\Result;

/**
 * @see https://docs.shipstation.com/openapi/labels
 */
class Label
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/labels/list_labels
     */
    public function listAll(): IterableResult
    {
        $op = Operation::fromSpec('GET /v2/labels');
        $result = new IterableResult('labels');
        return $this->client->__invoke($op, $result);
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/labels/create_label
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/labels')
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/labels/create_label_from_rate
     */
    public function createFromRate(string $rateId, array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/labels/%s')
            ->bindArgs($rateId)
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/labels/create_label_from_shipment
     */
    public function createFromShipment(string $shipmentId, array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/labels/shipment/%s')
            ->bindArgs($shipmentId)
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/labels/get_label_by_id
     */
    public function getById(string $labelId, string $label_download_type = 'url'): Result
    {
        $op = Operation::fromSpec('POST /v2/labels/%s')
            ->bindArgs($labelId)
            ->setQueryParams(compact('label_download_type'));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/labels/create_return_label
     */
    public function createReturn(string $labelId, array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/labels/%s/return')
            ->bindArgs($labelId)
            ->setBody($body);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/labels/get_tracking_log_from_label
     */
    public function track(string $labelId): Result
    {
        $op = Operation::fromSpec('POST /v2/labels/%s/track')
            ->bindArgs($labelId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/labels/void_label
     */
    public function void(string $labelId): Result
    {
        $op = Operation::fromSpec('PUT /v2/labels/%s/void')
            ->bindArgs($labelId);
        return $this->client->__invoke($op, new Result());
    }
}

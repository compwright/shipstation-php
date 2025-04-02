<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V2\Api;

use Compwright\EasyApi\ApiClient;
use Compwright\EasyApi\Operation;
use Compwright\EasyApi\OperationBody\JsonBody;
use Compwright\EasyApi\Result\EmptyResult;
use Compwright\EasyApi\Result\Json\IterableResult;
use Compwright\EasyApi\Result\Json\Result;

/**
 * @see https://docs.shipstation.com/openapi/webhooks
 */
class Webhook
{
    public function __construct(private ApiClient $client)
    {
    }

    /**
     * @see https://docs.shipstation.com/openapi/webhooks/list_webhooks
     */
    public function listAll(): Result
    {
        $op = Operation::fromSpec('GET /v2/environment/webhooks');
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/webhooks/create_webhook
     */
    public function create(array $body): Result
    {
        $op = Operation::fromSpec('POST /v2/environment/webhooks')
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @see https://docs.shipstation.com/openapi/webhooks/get_webhook_by_id
     */
    public function getById(string $webhookId): Result
    {
        $op = Operation::fromSpec('POST /v2/environment/webhooks/%s')
            ->bindArgs($webhookId);
        return $this->client->__invoke($op, new Result());
    }

    /**
     * @param array<string, mixed> $body
     *
     * @see https://docs.shipstation.com/openapi/webhooks/update_webhook
     */
    public function update(string $webhookId, array $body): EmptyResult
    {
        $op = Operation::fromSpec('PUT /v2/environment/webhooks/%s')
            ->bindArgs($webhookId)
            ->setBody(new JsonBody($body));
        return $this->client->__invoke($op, new EmptyResult());
    }

    /**
     * @see https://docs.shipstation.com/openapi/webhooks/delete_webhook
     */
    public function delete(string $webhookId): EmptyResult
    {
        $op = Operation::fromSpec('DELETE /v2/environment/webhooks/%s')
            ->bindArgs($webhookId);
        return $this->client->__invoke($op, new EmptyResult());
    }

    public function getPublicKeys(): IterableResult
    {
        $op = Operation::fromSpec('GET /v1/webhook-jwks.json');
        return $this->client->__invoke($op, new IterableResult('keys'));
    }
}

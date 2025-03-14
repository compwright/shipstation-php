<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use Compwright\ShipstationPhp\V2\ShippingApi;
use Compwright\ShouldRetry\RetryAfter;
use Compwright\ShouldRetry\ShouldRetry;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InvalidArgumentException;

class ShipstationApiFactory
{
    /** @var ?callable */
    private $rootHandler;

    public function __construct(?callable $rootHandler = null)
    {
        $this->rootHandler = $rootHandler;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function v1(string $apiKey, string $apiSecret, ?string $partnerApiKey = null): ApiClient
    {
        if (!$apiKey || !$apiSecret) {
            throw new InvalidArgumentException('Both $apiKey and $apiSecret are required');
        }

        $headers = [];
        if ($partnerApiKey) {
            $headers['x-partner'] = $partnerApiKey;
        }

        $handler = HandlerStack::create($this->rootHandler);
        $handler->push(
            Middleware::retry(
                new ShouldRetry(),
                (new RetryAfter())->setRetryAfterHeader('X-Rate-Limit-Reset')
            ),
            'retry'
        );

        $httpClient = new Client([
            'base_uri' => 'https://ssapi.shipstation.com',
            'headers' => $headers,
            'auth' => [$apiKey, $apiSecret],
            'handler' => $handler,
        ]);

        return new ApiClient($httpClient);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function v2(string $apiKey): ShippingApi
    {
        if (!$apiKey) {
            throw new InvalidArgumentException('$apiKey is required');
        }

        $handler = HandlerStack::create($this->rootHandler);
        $handler->push(
            Middleware::retry(
                new ShouldRetry(),
                new RetryAfter()
            ),
            'retry'
        );

        $httpClient = new Client([
            'base_uri' => 'https://api.shipstation.com/v2',
            'headers' => [
                'API-Key' => $apiKey,
            ],
            'handler' => $handler,
        ]);

        return new ShippingApi($httpClient);
    }
}

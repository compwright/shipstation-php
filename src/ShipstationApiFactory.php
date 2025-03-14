<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use Compwright\ShouldRetry\RetryAfter;
use Compwright\ShouldRetry\ShouldRetry;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\HttpFactory;
use InvalidArgumentException;

class ShipstationApiFactory
{
    /** @var ?callable */
    private $rootHandler;

    public function __construct(?callable $rootHandler = null)
    {
        $this->rootHandler = $rootHandler;
    }

    private function operationRequestFactory(): OperationRequestFactory
    {
        $httpFactory = new HttpFactory();
        return new OperationRequestFactory($httpFactory, $httpFactory);
    }

    /**
     * @throws InvalidArgumentException
     * 
     * @see https://www.shipstation.com/docs/api/requirements/
     */
    public function v1(string $apiKey, string $apiSecret, ?string $partnerApiKey = null): V1\LegacyApiCollection
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

        return new V1\LegacyApiCollection(
            new ApiClient(
                $httpClient,
                $this->operationRequestFactory()
            )
        );
    }

    /**
     * @template T of V2\ShippingApiCollection
     * @param class-string<T> $class
     * @return T
     * 
     * @throws InvalidArgumentException
     * 
     * @see https://docs.shipstation.com/authentication
     * @see https://docs.shipstation.com/rate-limits
     */
    public function v2(string $apiKey, string $class = V2\ShippingApiCollection::class): V2\ShippingApiCollection
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

        return new $class(
            new ApiClient(
                new Client([
                    'base_uri' => 'https://api.shipstation.com',
                    'headers' => [
                        'API-Key' => $apiKey,
                    ],
                    'handler' => $handler,
                ]),
                $this->operationRequestFactory()
            )
        );
    }
}

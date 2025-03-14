<?php

namespace Compwright\ShipstationPhp;

use BadMethodCallException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use JsonException;

class ApiClient
{
    protected ClientInterface $httpClient;

    /** @var array<string, string> */
    protected array $operations = [];

    protected string $baseUrl = '/';

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param mixed[] $args
     * 
     * @return mixed[]
     *
     * @throws BadMethodCallException
     */
    public function __call(string $name, array $args): ?array
    {
        if (!array_key_exists($name, $this->operations)) {
            throw new BadMethodCallException('Invalid operation: ' . $name);
        }

        return $this->__invoke(
            RequestFactory::createOperationRequest(
                new Request('GET', $this->baseUrl),
                $this->operations[$name],
                $args
            )
        );
    }

    /**
     * @return null|array<mixed>
     *
     * @throws ClientExceptionInterface if there is a problem with the request or response
     * @throws JsonException if there is a problem parsing the response body
     */
    public function __invoke(RequestInterface $request): ?array
    {
        $response = $this->httpClient->sendRequest($request);

        return json_decode(
            $response->getBody(),
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );
    }
}

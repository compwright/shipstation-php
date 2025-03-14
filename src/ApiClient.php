<?php

namespace Compwright\ShipstationPhp;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ApiClient
{
    public function __construct(
        private ClientInterface $httpClient,
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory
    ) {}

    /**
     * @template T of Result
     * @param T $result
     * @return T
     */
    public function __invoke(Operation $op, Result $result): Result
    {
        $request = $this->requestFactory->createRequest(
            $op->getMethod(),
            $op->getUri()
        );

        if ($op->hasBody()) {
            $stream = $this->streamFactory->createStream(
                json_encode($op->getBody(), JSON_THROW_ON_ERROR, 512)
            );
            $request = $request->withBody($stream)
                ->withHeader('Content-Type', 'application/json');
        }

        $response = $this->httpClient->sendRequest($request);
        $result->setResponse($response);

        return $result;
    }
}

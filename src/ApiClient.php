<?php

namespace Compwright\ShipstationPhp;

use Psr\Http\Client\ClientInterface;

class ApiClient
{
    public function __construct(
        private ClientInterface $httpClient,
        private OperationRequestFactory $requestFactory
    ) {}

    /**
     * @template T of Result
     * @param T $result
     * @return T
     */
    public function __invoke(Operation $op, Result $result): Result
    {
        $request = $this->requestFactory->createRequest($op);
        $response = $this->httpClient->sendRequest($request);
        $result->setResponse($response);
        return $result;
    }
}

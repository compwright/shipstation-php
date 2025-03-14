<?php

namespace Compwright\ShipstationPhp\Common;

use Compwright\ShipstationPhp\Common\Result\ResultInterface;
use Psr\Http\Client\ClientInterface;

class ApiClient
{
    public function __construct(
        private ClientInterface $httpClient,
        private OperationRequestFactory $requestFactory
    ) {
    }

    /**
     * @template T of ResultInterface
     * @param T $result
     * @return T
     */
    public function __invoke(Operation $op, ResultInterface $result): ResultInterface
    {
        $request = $this->requestFactory->createRequest($op);
        $response = $this->httpClient->sendRequest($request);
        $result->setResponse($response);
        return $result;
    }
}

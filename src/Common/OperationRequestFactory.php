<?php

namespace Compwright\ShipstationPhp\Common;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OperationRequestFactory
{
    public function __construct(
        private RequestFactoryInterface $requestFactory,
        private StreamFactoryInterface $streamFactory
    ) {
    }

    public function createRequest(Operation $op): RequestInterface
    {
        $request = $this->requestFactory->createRequest(
            $op->getMethod(),
            $op->getUri()
        );

        if ($op->hasQueryParams()) {
            $query = http_build_query($op->getQueryParams());
            $request = $request->withUri(
                $request->getUri()->withQuery($query)
            );
        }

        if ($op->hasBody()) {
            $stream = $this->streamFactory->createStream(
                json_encode($op->getBody(), JSON_THROW_ON_ERROR, 512)
            );
            $request = $request->withBody($stream)
                ->withHeader('Content-Type', 'application/json');
        }

        return $request;
    }
}

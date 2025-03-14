<?php

namespace Compwright\ShipstationPhp;

use GuzzleHttp\Psr7\Utils;
use LengthException;
use Psr\Http\Message\RequestInterface;

class RequestFactory
{
    /**
     * @param array<int|string|mixed> $args
     * 
     * @throws LengthException
     */
    public static function createOperationRequest(RequestInterface $request, string $operationSpec, array $args): RequestInterface
    {
        $operation = new Operation($operationSpec);

        $method = $operation->getMethod();

        $uri = $operation->interpolateUriArgs(
            array_splice($args, 0, count($operation)),
            $request->getUri()
        );

        $request = $request->withMethod($method)->withUri($uri);

        if (count($args) > 0 && $request->getMethod() === 'GET') {
            $queryArgs = array_shift($args);
            $request = $request->withUri(
                $request->getUri()->withQuery(
                    http_build_query($queryArgs)
                )
            );
        }

        if (count($args) > 0 && $request->getMethod() !== 'GET') {
            $bodyArgs = array_shift($args);
            $body = Utils::streamFor(json_encode($bodyArgs));
            $request = $request->withBody($body)
                ->withHeader('Content-Type', 'application/json');
        }

        if (count($args) > 0) {
            throw new LengthException(
                'Unexpected arguments remaining: ' . PHP_EOL . print_r($args, true)
            );
        }

        return $request;
    }
}

<?php

namespace Compwright\ShipstationPhp\Common;

use GuzzleHttp\Psr7\HttpFactory;
use PHPUnit\Framework\TestCase;

class OperationRequestFactoryTest extends TestCase
{
    public function testCreateRequestWithoutBody(): void
    {
        $op = Operation::fromSpec('GET /foo')->setQueryParams(['bar' => 'baz']);
        $httpFactory = new HttpFactory();
        $requestFactory = new OperationRequestFactory($httpFactory, $httpFactory);
        $request = $requestFactory->createRequest($op);
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/foo?bar=baz', (string) $request->getUri());
    }

    public function testCreateRequestWithBody(): void
    {
        $op = Operation::fromSpec('POST /foo')->setBody(['bar' => 'baz']);
        $httpFactory = new HttpFactory();
        $requestFactory = new OperationRequestFactory($httpFactory, $httpFactory);
        $request = $requestFactory->createRequest($op);
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/foo', (string) $request->getUri());
        $this->assertEquals('{"bar":"baz"}', (string) $request->getBody());
        $this->assertEquals('application/json', $request->getHeaderLine('Content-Type'));
    }
}

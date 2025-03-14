<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\V1\Api;

use Compwright\ShipstationPhp\ApiTestTrait;
use Compwright\ShipstationPhp\ShipstationApiFactory;
use Compwright\ShipstationPhp\V1\LegacyApiCollection;
use Psr\Http\Message\RequestInterface;

trait LegacyApiTestTrait
{
    use ApiTestTrait;

    protected LegacyApiCollection $legacy;

    /**
     * @before
     */
    protected function setupV1Api(): void
    {
        $factory = new ShipstationApiFactory($this->rootHandler);
        $this->legacy = $factory->legacyApi('foo', 'bar', 'baz');
    }

    /**
     * @param mixed $request
     */
    protected function assertRequestMatchesExpected(RequestInterface $expectedRequest, $request): void
    {
        $this->assertInstanceOf(get_class($expectedRequest), $request);
        $this->assertRequestHasMethod($request, $expectedRequest->getMethod());
        $this->assertRequestHasUri($request, (string) $expectedRequest->getUri());
        $this->assertMessageHasHeader($request, 'Authorization', 'Basic Zm9vOmJhcg==');
        $this->assertMessageHasHeader($request, 'x-partner', 'baz');
        $this->assertMessageHasHeader($request, 'User-Agent', 'GuzzleHttp/7');
        $this->assertSame((string) $expectedRequest->getBody(), (string) $request->getBody());
    }
}

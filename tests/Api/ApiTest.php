<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Api;

use Compwright\ShipstationPhp\ShipstationApiFactory;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Helmich\Psr7Assert\Psr7Assertions;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ApiTest extends TestCase
{
    use Psr7Assertions;

    private MockHandler $rootHandler;

    private LegacyApiCollection $legacy;

    // private ShippingApiCollection $shipping;

    protected function setUp(): void
    {
        $this->rootHandler = new MockHandler();
        $factory = new ShipstationApiFactory($this->rootHandler);
        $this->legacy = $factory->legacyApi('foo', 'bar', 'baz');
        // $this->shipping = $factory->shippingApi('foo');
    }

    protected function tearDown(): void
    {
        $this->rootHandler->reset();
    }

    private function getExpectedRequest(string $file): RequestInterface
    {
        $expectedRequest = Message::parseRequest(
            file_get_contents($file) ?: ''
        );

        return $expectedRequest->withUri(
            $expectedRequest->getUri()->withScheme('https')
        );
    }

    private function getExpectedResponse(int $status, ?string $file = null): Response
    {
        $response = new Response($status);

        if ($file) {
            return $response->withBody(Utils::streamFor(fopen($file, 'r')));
        }

        return $response;
    }

    /**
     * @param mixed $request
     */
    private function assertRequestMatchesExpected(RequestInterface $expectedRequest, $request): void
    {
        $this->assertInstanceOf(get_class($expectedRequest), $request);
        $this->assertRequestHasMethod($request, $expectedRequest->getMethod());
        $this->assertRequestHasUri($request, (string) $expectedRequest->getUri());
        $this->assertMessageHasHeader($request, 'Authorization', 'Basic Zm9vOmJhcg==');
        $this->assertMessageHasHeader($request, 'x-partner', 'baz');
        $this->assertMessageHasHeader($request, 'User-Agent', 'GuzzleHttp/7');
        $this->assertSame((string) $request->getBody(), (string) $expectedRequest->getBody());
    }

    public function testLegacyListTags(): void
    {
        $expectedRequest = $this->getExpectedRequest(__DIR__ . '/V1/tags/ListTagsRequest.txt');
        $expectedResponse = $this->getExpectedResponse(200, __DIR__ . '/V1/tags/ListTagsResponse.json');
        $this->rootHandler->append($expectedResponse);
        $result = $this->legacy->tag->listAll();
        $this->assertRequestMatchesExpected($expectedRequest, $this->rootHandler->getLastRequest());
        $this->assertSame($expectedResponse, $result->getResponse());
    }
}

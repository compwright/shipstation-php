<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Helmich\Psr7Assert\Psr7Assertions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

abstract class BaseApiTest extends TestCase
{
    use Psr7Assertions;

    protected MockHandler $rootHandler;

    protected V1\LegacyApiCollection $legacy;

    // private V1\ShippingApiCollection $shipping;

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

    protected function getExpectedRequest(string $file): RequestInterface
    {
        if (!file_exists($file)) {
            throw new InvalidArgumentException('File does not exist: ' . $file);
        }

        $expectedRequest = Message::parseRequest(
            file_get_contents($file) ?: ''
        );

        $expectedRequest = $expectedRequest->withUri(
            $expectedRequest->getUri()->withScheme('https')
        );

        $body = (string) $expectedRequest->getBody();
        if (strlen($body) > 0) {
            // Compact JSON
            $json = json_encode(json_decode($body, false, 512, JSON_THROW_ON_ERROR));
            $expectedRequest = $expectedRequest->withBody(Utils::streamFor($json));
        }

        return $expectedRequest;
    }

    protected function getExpectedResponse(int $status, ?string $file = null): Response
    {
        $response = new Response($status);

        if ($file) {
            if (!file_exists($file)) {
                throw new InvalidArgumentException('File does not exist: ' . $file);
            }
            return $response->withBody(Utils::streamFor(fopen($file, 'r')));
        }

        return $response;
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
        $this->assertSame((string) $request->getBody(), (string) $expectedRequest->getBody());
    }
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Helmich\Psr7Assert\Psr7Assertions;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;

trait ApiTestTrait
{
    use Psr7Assertions;

    protected MockHandler $rootHandler;

    /**
     * @before
     */
    protected function setupMockApi(): void
    {
        $this->rootHandler = new MockHandler();
    }

    /**
     * @after
     */
    protected function resetMockApi(): void
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
}

<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Result;

use GuzzleHttp\Psr7\Response;
use JsonException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ResultTest extends TestCase
{
    public function testGetSetResponse(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $result = new Result();
        $result->setResponse($response);
        $this->assertSame($response, $result->getResponse());
    }

    public function testValidJsonData(): void
    {
        $response = new Response(200, [], '{"foo":"bar"}');
        $result = (new Result())->setResponse($response);
        $data = $result->data();
        $this->assertEquals(['foo' => 'bar'], $data);
    }

    public function testBlankJsonData(): void
    {
        $result = (new Result())->setResponse(new Response(204));
        $data = $result->data();
        $this->assertEquals([], $data);
    }

    public function testInvalidJsonData(): void
    {
        $result = (new Result())->setResponse(new Response(200, [], '<html></html>'));
        $this->expectExceptionObject(
            new JsonException('Syntax error', JSON_ERROR_SYNTAX)
        );
        $result->data();
    }
}

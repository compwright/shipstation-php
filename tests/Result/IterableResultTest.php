<?php

declare(strict_types=1);

namespace Compwright\ShipstationPhp\Result;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class IterableResultTest extends TestCase
{
    public function testValidJsonData(): void
    {
        $response = new Response(200, [], '{"foo":["bar"]}');
        $result = (new IterableResult('foo'))->setResponse($response);
        $this->assertEquals(['foo' => ['bar']], $result->data());
        $this->assertCount(1, $result);
        $this->assertEquals(['bar'], iterator_to_array($result));
    }

    public function testBlankJsonData(): void
    {
        $result = (new IterableResult('foo'))->setResponse(new Response(204));
        $data = $result->data();
        $this->assertEquals([], $data);
        $this->assertCount(0, $result);
        $this->assertEquals([], iterator_to_array($result));
    }
}
